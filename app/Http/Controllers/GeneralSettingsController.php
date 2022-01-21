<?php

namespace App\Http\Controllers;

use App\MediaUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use App\PopupBuilder;
use Intervention\Image\Facades\Image;
use Symfony\Component\Process\Process;

class GeneralSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function regenerate_image_settings(){
        /**

         * @get('/admin-home/general-settings/regenerate-image')
         * @name('admin.general.regenerate.thumbnail')
         * @middlewares(web, general_settings, auth:admin)
         */
        return view('backend.general-settings.regenerate-image');
    }

    public function update_regenerate_image_settings (Request $request){
        /**

         * @post('/admin-home/general-settings/regenerate-image')
         * @name('')
         * @middlewares(web, general_settings, auth:admin)
         */
        $all_media_file = MediaUpload::all();
        foreach ($all_media_file as $img){

            if (!file_exists('assets/uploads/media-uploader/'.$img->path)){
                continue;
            }
            $image = 'assets/uploads/media-uploader/'. $img->path;
            $image_dimension = getimagesize($image);;
            $image_width = $image_dimension[0];
            $image_height = $image_dimension[1];

            $image_db = $img->path;
            $image_grid = 'grid-'.$image_db ;
            $image_large = 'large-'. $image_db;
            $image_thumb = 'thumb-'. $image_db;

            $folder_path = 'assets/uploads/media-uploader/';
            $resize_grid_image = Image::make($image)->resize(350, null,function ($constraint) {
                $constraint->aspectRatio();
            });
            $resize_large_image = Image::make($image)->resize(740, null,function ($constraint) {
                $constraint->aspectRatio();
            });
            $resize_thumb_image = Image::make($image)->resize(150, 150);

            if ($image_width > 150){
                $resize_thumb_image->save($folder_path . $image_thumb);
                $resize_grid_image->save($folder_path . $image_grid);
                $resize_large_image->save($folder_path . $image_large);
            }

        }

        return redirect()->back()->with(['msg' => 'Image Regenerate Success...','type' => 'success']);
    }

    public function gdpr_settings()
    {
        /**

         * @get('/admin-home/general-settings/gdpr-settings')
         * @name('admin.general.gdpr.settings')
         * @middlewares(web, general_settings, auth:admin)
         */
        return view('backend.general-settings.gdpr');
    }

    public function update_gdpr_cookie_settings(Request $request)
    {
        /**

         * @post('/admin-home/general-settings/gdpr-settings')
         * @name('')
         * @middlewares(web, general_settings, auth:admin)
         */

        $this->validate($request, [
            'site_gdpr_cookie_enabled' => 'nullable|string|max:191',
            'site_gdpr_cookie_expire' => 'required|string|max:191',
            'site_gdpr_cookie_delay' => 'required|string|max:191',
        ]);

            $this->validate($request, [
                "site_gdpr_cookie_title" => 'nullable|string',
                "site_gdpr_cookie_message" => 'nullable|string',
                "site_gdpr_cookie_more_info_label" => 'nullable|string',
                "site_gdpr_cookie_more_info_link" => 'nullable|string',
                "site_gdpr_cookie_accept_button_label" => 'nullable|string',
            ]);
            $_title = "site_gdpr_cookie_title";
            $_message = "site_gdpr_cookie_message";
            $_more_info_label = "site_gdpr_cookie_more_info_label";
            $_more_info_link = "site_gdpr_cookie_more_info_link";
            $_accept_button_label = "site_gdpr_cookie_accept_button_label";

            update_static_option($_title,$request->$_title);
            update_static_option($_message,$request->$_message);
            update_static_option($_more_info_label,$request->$_more_info_label);
            update_static_option($_more_info_link,$request->$_more_info_link);
            update_static_option($_accept_button_label,$request->$_accept_button_label);

        update_static_option('site_gdpr_cookie_delay', $request->site_gdpr_cookie_delay);
        update_static_option('site_gdpr_cookie_enabled', $request->site_gdpr_cookie_enabled);
        update_static_option('site_gdpr_cookie_expire', $request->site_gdpr_cookie_expire);

        return redirect()->back()->with(['msg' => 'GDPR Cookie Settings Updated..', 'type' => 'success']);
    }

    public function cache_settings()
    {
        /**

         * @get('/admin-home/general-settings/cache-settings')
         * @name('admin.general.cache.settings')
         * @middlewares(web, general_settings, auth:admin)
         */
        return view('backend.general-settings.cache-settings');
    }

    public function update_cache_settings(Request $request)
    {
        /**

         * @post('/admin-home/general-settings/cache-settings')
         * @name('')
         * @middlewares(web, general_settings, auth:admin)
         */

        $this->validate($request, [
            'cache_type' => 'required|string'
        ]);

        Artisan::call($request->cache_type . ':clear');

        return redirect()->back()->with(['msg' => 'Cache Cleaned...', 'type' => 'success']);
    }

    public function backup_settings()
    {
        /**

         * @get('/admin-home/general-settings/backup-settings')
         * @name('admin.general.backup.settings')
         * @middlewares(web, general_settings, auth:admin)
         */
        $all_backuped_db = glob('backup/*');
        return view('backend.general-settings.backup')->with(['all_backuped_db' => $all_backuped_db]);
    }

    public function update_backup_settings(Request $request)
    {
        /**

         * @post('/admin-home/general-settings/backup-settings')
         * @name('')
         * @middlewares(web, general_settings, auth:admin)
         */

        $process = new Process(sprintf(
            'mysqldump -u%s -p%s %s > %s',
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.database'),
            'backup/' . config('database.connections.mysql.database') . '_' . date('j_F_Y_h:m:s') . '.sql'
        ));
        $process->mustRun();
        return redirect()->back()->with(['msg' => 'Database Backup Completed...', 'type' => 'success']);
    }

    public function delete_backup_settings(Request $request)
    {
        /**

         * @post('/admin-home/general-settings/backup-settings/delete')
         * @name('admin.general.backup.settings.delete')
         * @middlewares(web, general_settings, auth:admin)
         */

        if (file_exists($request->db_name)) {
            unlink($request->db_name);
        }

        return redirect()->back()->with(['msg' => 'Database Deleted...', 'type' => 'danger']);
    }

    public function restore_backup_settings(Request $request)
    {
        /**

         * @post('/admin-home/general-settings/backup-settings/restore')
         * @name('admin.general.backup.settings.restore')
         * @middlewares(web, general_settings, auth:admin)
         */
        $process = new Process(sprintf(
            'mysql -u%s -p%s %s < %s',
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.database'),
            'backup/' . $request->db_name
        ));
        $process->mustRun();
        return redirect()->back()->with(['msg' => 'Database Restore Completed...', 'type' => 'success']);
    }

    public function email_settings()
    {
        /**

         * @get('/admin-home/general-settings/email-settings')
         * @name('admin.general.email.settings')
         * @middlewares(web, general_settings, auth:admin)
         */
        return view('backend.general-settings.email-settings');
    }

    public function update_email_settings(Request $request)
    {
        /**

         * @post('/admin-home/general-settings/email-settings')
         * @name('')
         * @middlewares(web, general_settings, auth:admin)
         */
            $this->validate($request, [
                'order_mail_subject' => 'nullable|string',
                'quote_mail_subject' => 'nullable|string',
                'contact_mail_subject' => 'nullable|string',
                'request_call_back_mail_subject' => 'nullable|string'
            ]);

            $order_mail = 'order_mail_subject';
            $quote_mail = 'quote_mail_subject';
            $contact_mail = 'contact_mail_subject';
            $request_call_back_mail = 'request_call_back_mail_subject';

            update_static_option($order_mail, $request->$order_mail);
            update_static_option($quote_mail, $request->$quote_mail);
            update_static_option($contact_mail, $request->$contact_mail);
            update_static_option($request_call_back_mail, $request->$request_call_back_mail);
        return redirect()->back()->with(['msg' => 'Email Settings Updated..', 'type' => 'success']);
    }

    public function basic_settings()
    {
        /**

         * @get('/admin-home/general-settings/basic-settings')
         * @name('admin.general.basic.settings')
         * @middlewares(web, general_settings, auth:admin)
         */
        return view('backend.general-settings.basic');
    }

    public function update_basic_settings(Request $request)
    {
        /**

         * @post('/admin-home/general-settings/basic-settings')
         * @name('')
         * @middlewares(web, general_settings, auth:admin)
         */
        $this->validate($request, [
            'whats_app_number' => 'nullable|string',
            'whats_app_message' => 'nullable|string',
            'site_maintenance_mode' => 'nullable|string',
            'site_payment_gateway' => 'nullable|string',
        ]);
        update_static_option('whats_app_number', $request->whats_app_number);
        update_static_option('whats_app_message', $request->whats_app_message);
        update_static_option('site_maintenance_mode',$request->site_maintenance_mode);
        update_static_option('site_payment_gateway',$request->site_payment_gateway);

        return redirect()
            ->back()
            ->with([
                'msg' => 'Basic Settings Update Success',
                'type' => 'success',
            ]);
    }

    public function seo_settings()
    {
        /**

         * @get('/admin-home/general-settings/seo-settings')
         * @name('admin.general.seo.settings')
         * @middlewares(web, general_settings, auth:admin)
         */
        return view('backend.general-settings.seo');
    }

    public function update_seo_settings(Request $request)
    {
        /**

         * @post('/admin-home/general-settings/seo-settings')
         * @name('')
         * @middlewares(web, general_settings, auth:admin)
         */
        $this->validate($request, [
            'site_meta_tags' => 'required|string',
            'site_meta_description' => 'required|string'
        ]);

        update_static_option('site_meta_tags', $request->site_meta_tags);
        update_static_option('site_meta_description', $request->site_meta_description);

        return redirect()->back()->with(['msg' => 'SEO Settings Update Success', 'type' => 'success']);
    }

    public function email_template_settings()
    {
        /**

         * @get('/admin-home/general-settings/email-template')
         * @name('admin.general.email.template')
         * @middlewares(web, general_settings, auth:admin)
         */
        return view('backend.general-settings.email-template');
    }

    public function update_email_template_settings(Request $request)
    {
        /**

         * @post('/admin-home/general-settings/email-template')
         * @name('')
         * @middlewares(web, general_settings, auth:admin)
         */

        $this->validate($request, [
            'site_global_email' => 'required|string',
            'site_global_email_template' => 'required|string',
        ]);

        update_static_option('site_global_email', $request->site_global_email);
        update_static_option('site_global_email_template', $request->site_global_email_template);

        return redirect()->back()->with(['msg' => 'Email Settings Updated..', 'type' => 'success']);
    }
    public function site_identity()
    {
        /**

         * @get('/admin-home/general-settings/site-identity')
         * @name('admin.general.site.identity')
         * @middlewares(web, general_settings, auth:admin)
         */
        return view('backend.general-settings.site-identity');
    }

    public function update_site_identity(Request $request)
    {
        /**

         * @post('/admin-home/general-settings/site-identity')
         * @name('')
         * @middlewares(web, general_settings, auth:admin)
         */
        $this->validate($request, [
            'site_logo' => 'nullable|string|max:191',
            'site_favicon' => 'nullable|string|max:191',
        ]);
        update_static_option('site_logo', $request->site_logo);
        update_static_option('site_favicon', $request->site_favicon);

        return redirect()->back()->with([
            'msg' => 'Site Identity Has Been Updated..',
            'type' => 'success'
        ]);
    }

    public function payment_settings(){
        /**

         * @get('/admin-home/general-settings/payment-settings')
         * @name('admin.general.payment.settings')
         * @middlewares(web, general_settings, auth:admin)
         */
        return view('backend.general-settings.payment-gateway');
    }

    public function update_payment_settings(Request $request)
    {
        /**

         * @post('/admin-home/general-settings/payment-settings')
         * @name('')
         * @middlewares(web, general_settings, auth:admin)
         */
        $this->validate($request, [
            'paytm_gateway' => 'nullable|string|max:191',
            'paytm_preview_logo' => 'nullable|string|max:191',
            'paytm_merchant_key' => 'nullable|string|max:191',
            'paytm_merchant_mid' => 'nullable|string|max:191',
            'paytm_merchant_website' => 'nullable|string|max:191',
            'site_global_currency' => 'nullable|string|max:191',
            'site_usd_to_nri_exchange_rate' => 'nullable|string|max:191',
            'site_manual_payment_name' => 'nullable|string|max:191',
            'manual_payment_preview_logo' => 'nullable|string|max:191',
            'site_manual_payment_description' => 'nullable|string|max:191',
        ]);
        $save_data = [
            'paytm_preview_logo',
            'paytm_merchant_key',
            'paytm_merchant_mid',
            'paytm_merchant_website',
            'site_global_currency',
            'site_usd_to_nri_exchange_rate',
            'manual_payment_preview_logo',
            'site_manual_payment_name',
            'site_manual_payment_description',
        ];
        foreach ($save_data as $item) {
            if (empty($request->$item)) {
                continue;
            }
            update_static_option($item, $request->$item);
        }

        update_static_option(
            'manual_payment_gateway',
            $request->manual_payment_gateway
        );
        update_static_option('paytm_gateway', $request->paytm_gateway);

        return redirect()
            ->back()
            ->with([
                'msg' => 'Payment Settings Updated..',
                'type' => 'success',
            ]);
    }
    public function popup_settings()
    {
        /**

         * @get('/admin-home/general-settings/popup-settings')
         * @name('admin.general.popup.settings')
         * @middlewares(web, general_settings, auth:admin)
         */
        $all_popup = PopupBuilder::all();
        // echo($all_popup);
        // exit();
        return view('backend.general-settings.popup-settings')->with(['all_popup' => $all_popup]);
    }

    public function update_popup_settings(Request $request)
    {
        /**

         * @post('/admin-home/general-settings/popup-settings')
         * @name('')
         * @middlewares(web, general_settings, auth:admin)
         */
        $this->validate($request, [
            'popup_enable_status' => 'nullable|string',
            'popup_delay_time' => 'nullable|string',
            'popup_selected_id' => 'nullable|string',
        ]);
        update_static_option('popup_enable_status', $request->popup_enable_status);
        update_static_option('popup_delay_time', $request->popup_delay_time);
        update_static_option('popup_selected_id', $request->popup_selected_id);
        

        return redirect()->back()->with(['msg' => __('Settings Updated'), 'type' => 'success']);
    }

}