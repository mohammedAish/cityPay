<?php


namespace App\Http\Controllers\Auth\Traits;

use App\Helpers\UrlGen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

trait VerificationTrait
{
    use EmailVerificationTrait, PhoneVerificationTrait, RecognizedUserActionsTrait;

    public $entitiesRefs = [
        'customer' => [
            'slug'      => 'customer',
            'namespace' => '\\App\Models\Customer',
            'name'      => 'name',
            'scopes'    => [
                \App\Models\Scopes\VerifiedScope::class,
            ],
        ],
    ];

    /**
     * URL: Verify User's Email Address or Phone Number
     *
     * @param $field
     * @param  null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function verification($field, $token = null) {
        // Keep Success Message If exists
        if (session()->has('message')) {
            session()->keep(['message']);
        }

        // Get Entity
        $entityRef = $this->getEntityRef(request()->segment(3));
        if (empty($entityRef)) {
            abort(404, t("Entity ID not found"));
        }

        // Get Field Label
        $fieldLabel = t('email_address');
        if ($field == 'phone') {
            $fieldLabel = t('phone_number');
        }

        // Show Token Form
        if (empty($token) && !request()->filled('_token')) {
            return;//view('token');
        }

        // Token Form Submission
        if (request()->filled('_token')) {
            // Form validation
            $validator = Validator::make(request()->all(), ['code' => 'required']);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            if (request()->filled('code')) {
                return redirect('verify/'.$entityRef['slug'].'/'.$field.'/'.request()->get('code'));
            }
        }

        // Get Entity by Token
        $model  = $entityRef['namespace'];
        $entity = $model::withoutGlobalScopes($entityRef['scopes'])->where($field.'_token', $token)->first();

        if (!empty($entity)) {
            if ($entity->{'verified_'.$field} != 1 || is_null( $entity->email_verified_at)) {
                // Verified
                $entity->{'verified_'.$field} = 1;
                $entity->markEmailAsVerified();
                $entity->save();

                $message = t("Your field has been verified",
                    ['name' => $entity->{$entityRef['name']}, 'field' => $fieldLabel]);
                flash($message)->success();

                // Remove Notification Trigger
                if (session()->has('emailOrPhoneChanged')) {
                    session()->forget('emailOrPhoneChanged');
                }
                if (session()->has('verificationEmailSent')) {
                    session()->forget('verificationEmailSent');
                }
                if (session()->has('verificationSmsSent')) {
                    session()->forget('verificationSmsSent');
                }
            } else {
                $message = t("Your field is already verified", ['field' => $fieldLabel]);
                flash($message)->error();
            }

            // Get Next URL
            // Get Default next URL
            $nextUrl = '/?from=verification';

            // Is User Entity
            if ($entityRef['slug'] == 'customer') {

                // Get User creation next URL
                // Login the User
                if (Auth::loginUsingId($entity->id)) {
                    $nextUrl = 'dashboard';
                } else {
                    if (session()->has('userNextUrl')) {
                        $nextUrl = session('userNextUrl');
                    } else {
                        $nextUrl = 'login';
                    }
                }
            }



            // Remove Next URL session
            if (session()->has('userNextUrl')) {
                session()->forget('userNextUrl');
            }
            if (session()->has('itemNextUrl')) {
                session()->forget('itemNextUrl');
            }

            // Redirection
            return redirect($nextUrl);
        } else {
            $message = t("Your field verification has failed", ['field' => $fieldLabel]);
            flash($message)->error();

            return;//view('token');
        }
    }

    /**
     * @param  null  $entityRefId
     * @return null
     */
    public function getEntityRef($entityRefId = null) {
        if (empty($entityRefId)) {
            if (
            Str::contains(Route::currentRouteAction(), 'Auth\RegisterController')
            ) {
                $entityRefId = 'customer';
            }

//			if (
//                    //todo ZAHER complete to do when deposit or withdraw
//				/*Str::contains(Route::currentRouteAction(), 'Post\CreateOrEdit\MultiSteps\CreateController') ||
//				Str::contains(Route::currentRouteAction(), 'Post\CreateOrEdit\MultiSteps\EditController') ||
//				Str::contains(Route::currentRouteAction(), 'Post\CreateOrEdit\SingleStep\CreateController') ||
//				Str::contains(Route::currentRouteAction(), 'Post\CreateOrEdit\SingleStep\EditController') ||
//				Str::contains(Route::currentRouteAction(), 'Admin\PostController')*/
//			) {
//				$entityRefId = 'post';
//			}
        }

        // Check if Entity exists
        if (!isset($this->entitiesRefs[$entityRefId])) {
            return null;
        }

        // Get Entity
        $entityRef = $this->entitiesRefs[$entityRefId];

        return $entityRef;
    }
}
