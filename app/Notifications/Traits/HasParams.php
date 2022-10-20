<?php


namespace App\Notifications\Traits;


use App\Models\EmailTemplate;

trait HasParams
{
    public function getEmailParams($notifiable) {
        $op_type = $this->deposit_order->op_type;
        $status  = $this->deposit_order->current_status;
        $params  = EmailTemplate::where('category', strtoupper($op_type))
            ->where('name', strtoupper($op_type).'_'.strtoupper($status))->first();
        if (!$params) {
            return null;
        }
        $params = $this->reGenerateParams($params, $notifiable);

        return $params;

    }

    private function reGenerateParams($params, $notifiable): object {
        /*
         * `category`, `action`, `name`, `explain`, `subject`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`
         */
        foreach ($params->toArray() as $column => $value) {
            $params->{$column} = $this->shortcode_replacer("{{amount}}", $notifiable->amount, $value);
            // $params->{$column} = $this->shortcode_replacer("{{amount2}}", trans('lang.amount'), $value);
            $params->{$column} = $this->shortcode_replacer("{{op_code}}", $notifiable->order_code, $value);
            logger([$column, $value, $params->{$column}]);
        }


    }

    function shortcode_replacer($shortcode, $replace_with, $template_string) {
        return str_replace($shortcode, $replace_with, $template_string);
    }
}