<?php

namespace App\Http\Controllers\Account;

use App\CustomerCode;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CommonTrait;
use App\Http\Controllers\Traits\WalletTrait;
use App\Http\Requests\IdentityDocumentationRequest;
use App\Http\Requests\UpadatePasswordRequest;
use App\Http\Requests\UpdateIdentityDocumentationRequest;
use App\Http\Resources\CountryResource;
use App\Http\Resources\FinanceAccountResource;
use App\IdentityDocumentation;
use App\Models\ChatUser;
use App\Models\Customer;
use App\Models\CustomerFinanceAccount;
use App\Models\ErrorReport;
use App\Notifications\ErrorReportNotification;
use App\Notifications\IdentityDocumentationStatusUpdate;
use App\Notifications\OrderNotification;
use App\RecordActivity;
use App\Rules\MatchOldPassword;
use App\Rules\PhoneCountryRule;
use App\Wallet\Msegat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProfileController extends AccountBaseController
{
    use WalletTrait, CommonTrait;

    public function profileInfo()
    {
        if (!auth()->user()->hasVerifiedEmail()) {
            return Redirect::route('verification.notice');
        }
        $this->leftMenuInfo();
        $this->data['countries'] = CountryResource::collection($this->getActiveCountries());
        $activities = RecordActivity::query()->where('customer_id', auth()->id())->whereIn('type', [1, 2])->get();
        $identity_document = IdentityDocumentation::query()
            ->where('customer_id', auth()->id())
//            ->where('status', 1)
            ->latest()->first();
        return view('profile.profile2')
            ->with('collected_data', $this->data)
            ->with('active_menu', 'profile')
            ->with('activities', $activities)
            ->with('identity_document', $identity_document)
            ->with('profile_info', $this->data['customer_info']);
        //  return view('home')->with('profile_info',$my_data);
    }

    public function updateInfo(Request $request)
    {
        try {
            if ($request->hasFile('fileup')) {
                $path = $this->createImageFromFile($request, 'fileup', 'customers');
            } else {
                $path = auth()->user()->img_profile;
            }
            $input = $request->except('_token', '_method', 'fileup');
            $input['img_profile'] = $path;
            Customer::where('id', auth()->id())->update($input);
            $this->data['user_info'] = auth()->user();
        } catch (\Exception $e) {
            redirect()->back()->withErrors($e->getMessage())->withInput();
        }

        $this->data['customer_info'] = Customer::whereId(auth()->id())
            ->with('financeAccounts', 'country')
            ->first();

        return $request->wantsJson()
            ? response()->json($this->data['customer_info'])
            : redirect(route('profile_info'));
    }

    public function saveProfileImage(Request $request)
    {
        $path = $this->createImageFromFile($request, 'fileup', 'customers');
        $updated = auth()->user()->update(["img_profile" => $path]);

        return ["status" => "success", "data" => asset($path), "message" => "تم التعديل بنجاح"];
    }

    public function list_finance_accounts()
    {
        $listAccs = $this->getCustomerFinanceAccounts(/*auth()->id()*/ 5);
        $this->data['finance_accounts'] = FinanceAccountResource::collection($listAccs);

        //return response()->json($this->data['finance_accounts']);

        return \request()->wantsJson()
            ? response()->json($this->data['finance_accounts'])
            : view('account.profile')
                ->with('finance_accounts', $this->data['finance_accounts']);
    }


    public function updatePassword(Request $request)
    {

        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'password'     => 'required|string|min:6|confirmed',
        ]);

        Customer::find(auth()->user()->id)->update(['password' => Hash::make($request->password)]);
        $chatUserInfo = ChatUser::where('email', auth()->user()->email)->first();
        if ($chatUserInfo) {
            $chatUserInfo->update(['pass' => md5($chatUserInfo->id . $request->password)]);
        }

        return redirect()->back()->with('msg', 'you updated password success');
    }


    public function dashboardData()
    {
        $this->leftMenuInfo();

        return view('profile.dashboard')->with('profile_data', $this->data);
    }




    //================DEPRECATED FUNC===================

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @deprecated
     */
    public function updateFinanceAccounts(Request $request)
    {
//        $accountsIdsArray = $request->input('accounts_ids');
//        foreach ($accountsIdsArray as $onAccountKey => $accountIdValue) {
//            CustomerFinanceAccount::where('customer_id',/*auth()->id*/ 5)
//                ->where('agency_id', $onAccountKey)
//                ->update(['customer_agency_acc_number' => $accountIdValue]);
//        }
//        $this->data['customer_info'] = Customer::whereId(auth()->id())
//            ->with('financeAccounts')->first();
//
//        return view('account.profile')
//            ->with('profile_info', $this->data['customer_info']);
    }

    public function saveIdentityDocument(IdentityDocumentationRequest $request)
    {
        try {
            $inputs = $request->except('_token', 'document_file', 'manager_address');

//            $document_file = $this->createImageFromFile($request, 'document_file', 'documents');
//            $manager_address = $this->createImageFromFile($request, 'manager_address', 'documents');
//            $inputs['document_file'] = $document_file;
//            $inputs['manager_address'] = $manager_address;
            $inputs['customer_id'] = auth()->id();
//            $inputs['email'] = auth()->user()->email;
            $inputs['status'] = - 1;

            $identityDocumentationExi = IdentityDocumentation::query()
                ->where('email', auth()->user()->email)
                ->where('status', 1)
                ->latest()->first();
            if ($identityDocumentationExi) {
                return [
                    'success' => true,
                    'message' => cp('data_saved_successfully'),
                    'data'    => [
                        'document_id' => $identityDocumentationExi->id
                    ],
                ];
            }

            $identityDocumentation = IdentityDocumentation::query()->updateOrCreate(['email' => auth()->user()->email], $inputs);
            //TODO::send email to ver@ctpay.uk
//            auth()->user()->notify(new IdentityDocumentationStatusUpdate('identity_documentation_sent_subject', 'identity_documentation_sent_description'));

            $response = [
                'success' => true,
                'message' => cp('data_saved_successfully'),
                'data'    => [
                    'document_id' => $identityDocumentation->id
                ],
            ];

        } catch (\Exception $e) {
//            redirect()->back()->withErrors($e->getMessage())->withInput();
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response);
//        return redirect(route('profile_info') . "#kt_Identity_Documentation_tab");
    }

    public function updateIdentityDocumentFiles(UpdateIdentityDocumentationRequest $request)
    {
        try {
            $document_file = $this->createImageFromFile($request, 'document_file', 'documents');
            $manager_address = $this->createImageFromFile($request, 'manager_address', 'documents');
            $inputs['document_file'] = $document_file;
            $inputs['manager_address'] = $manager_address;
            $inputs['document_type'] = $request->get('document_type');
            $inputs['status'] = 0;

            IdentityDocumentation::query()
                ->where('id', $request->get('document_id'))
                ->update($inputs);

            auth()->user()->notify(new IdentityDocumentationStatusUpdate('identity_documentation_sent_subject', 'identity_documentation_sent_description'));

        } catch (\Exception $exception) {
            redirect()->back()->withErrors($exception->getMessage())->withInput();
        }

        return redirect(route('profile_info') . "#kt_Identity_Documentation_tab");
    }

    public function sendMobileVerificationSms(Request $request)
    {
        try {
            $user = auth()->user();

            if (!$request->has('mobile')) {
                throw new \Exception('mobile is required');
            }

            CustomerCode::query()->create([
                'code'        => random_int(100000, 999999),
                'type'        => 'identity_mobile_verification',
                'mobile'      => $request->get('mobile'),
                'customer_id' => $user->id,
            ]);
//            Msegat::sendSMS();
            $response = [
                'success' => true,
                'message' => cp('code_sent_successfully'),
                'data'    => [],
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
        return response()->json($response);
    }


    public function checkVerificationCode(Request $request)
    {
        try {
            $user = auth()->user();

            if (!$request->has('code')) {
                throw new \Exception('code is required');
            }
            $verificationCode = $request->get('code');
            $customerCode = CustomerCode::query()
                ->where('customer_id', $user->id)
                ->where('type', 'identity_mobile_verification')
                ->latest()
                ->first();

            if ($customerCode && $customerCode->code == $verificationCode) {
                $response = [
                    'success' => true,
                    'message' => cp('verification_successfully'),
                    'data'    => [],
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => cp('wrong_verification_code'),
                    'data'    => [],
                ];
            }

        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
        return response()->json($response);
    }

    public function sendErrorReport(Request $request)
    {
        try {
            $user = auth()->user();

            if (empty($request->get('error_link')) || empty($request->get('error_action'))) {
                throw new \Exception('there are missing fields');
            }

            if (!$request->hasFile('error_file')) {
                throw new \Exception('file is required');
            }

            $error_file = '';

            $error = ErrorReport::query()->create([
                'error_link'   => $request->get('error_link'),
                'error_action' => $request->get('error_action'),
                'error_file'   => $error_file,
                'customer_id'  => $user->id,
            ]);

            auth()->user()->notify(new ErrorReportNotification('error_report_subject_new', 'error_report_description_new', $error->id));

            $response = [
                'success' => true,
                'message' => cp('error_report_sent_successfully'),
            ];

        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
        return response()->json($response);
    }

    public function updateProtectionAndSecurity(Request $request)
    {
        try {
            if (is_null($request->get('confirmation_notification')) || is_null($request->get('confirmation_method'))) {
                throw new \Exception('there are missing fields');
            }

            $isMasterKeyEnabled = $request->get('is_master_key_enabled', 1);

            if ($isMasterKeyEnabled == 1 && empty($request->get('master_key'))) {
                throw new \Exception(cp('master_key_is_required'));
            }

            $masterKey = $request->get('master_key', '');

            if ($isMasterKeyEnabled == 1 && (strlen($masterKey) < 3 || strlen($masterKey) > 3)) {
                throw new \Exception(cp('master_key_must_be_3_numbers'));
            }

            DB::table('customers')->where('id', auth()->id())->update([
                'confirmation_notification' => $request->get('confirmation_notification'),
                'confirmation_method'       => $request->get('confirmation_method'),
                'is_master_key_enabled'     => $isMasterKeyEnabled,
                'master_key'                => $isMasterKeyEnabled ? $masterKey : '',
            ]);

            $response = [
                'success' => true,
                'message' => cp('protection_and_security_updated_successfully'),
            ];

        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
        return response()->json($response);
    }

    public function update_notification(Request $request)
    {
        try {
            $incoming_payment_notification = $request->get('incoming_payment_notification', 1);

            $minimum_notification = $request->get('minimum_notification', '');

            DB::table('customers')->where('id', auth()->id())->update([
                'incoming_payment_notification' => $incoming_payment_notification,
                'minimum_notification'          => $minimum_notification,
            ]);

            $response = [
                'success' => true,
                'message' => cp('notification_updated_successfully'),
            ];

        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
        return response()->json($response);
    }

    public function checkUserMasterKey(Request $request)
    {
        try {
            $masterKey = $request->get('master_key', '');

            if (!auth()->user()->is_master_key_enabled) {
                return response()->json([
                    'success' => true,
                    'message' => cp('success'),
                ]);
            }

            if (auth()->user()->master_key == $masterKey) {
                $response = [
                    'success' => true,
                    'message' => cp('success'),
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => cp('wrong_master_key_entered'),
                ];
            }
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
        return response()->json($response);
    }
}
