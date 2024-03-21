<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//=====================================Pharmacy Routes===============================================
$route['print_home_meds/(:any)/(:any)'] = 'pages/print_home_meds/$1/$2';
$route['bridge/(:any)'] = 'pages/bridge/$1';
//===================================================================================================
//=====================================Billing Routes================================================
$route['print_daily_discharged_report_alpha'] = 'pages/print_daily_discharged_report_alpha';
$route['delete_billing_report/(:any)/(:any)'] = 'pages/delete_billing_report/$1/$2';
$route['save_billing_report'] = 'pages/save_billing_report';
$route['report_settings'] = 'pages/report_settings';
$route['print_daily_discharged_report_beta'] = 'pages/print_daily_discharged_report_beta';
$route['print_daily_discharged_summary_beta'] = 'pages/print_daily_discharged_summary_beta';
$route['remove_refund/(:any)/(:any)'] = 'pages/remove_refund/$1/$2';
$route['save_refund'] = 'pages/save_refund';
$route['manage_refund/(:any)'] = 'pages/manage_refund/$1';
$route['search_patient_refund'] = 'pages/search_patient_refund';
$route['patient_refund'] = 'pages/patient_refund';
$route['post_refund/(:any)/(:any)/(:any)'] = 'pages/post_refund/$1/$2/$3';
$route['print_daily_discharged_report_excel'] = 'pages/print_daily_discharged_report_excel';
$route['print_daily_discharged_report'] = 'pages/print_daily_discharged_report';
$route['print_daily_discharged_summary'] = 'pages/print_daily_discharged_summary';
//===================================================================================================
//=====================================Cashier Routes================================================
$route['artrade_indexcard/(:any)'] = 'pages/artrade_indexcard/$1';
$route['artrade_list_search'] = 'pages/artrade_list_search';
$route['artrade_list'] = 'pages/artrade_list';
$route['cashier_reports'] = 'pages/cashier_reports';
$route['print_daily_collection'] = 'pages/print_daily_collection';
$route['daily_collection'] = 'pages/daily_collection';
$route['professional_fee'] = 'pages/professional_fee';
//===================================================================================================
//=================================HMO Routes================================================================
$route['print_dialysis_summary'] = 'pages/print_dialysis_summary';
$route['dialysis_summary'] = 'pages/dialysis_summary';
$route['dialysis_report/(:any)/(:any)/(:any)'] = 'pages/dialysis_report/$1/$2/$3';
$route['rdu_hmo'] = 'pages/rdu_hmo';
$route['active_ar_patient'] = 'pages/active_ar_patient';
$route['delete_soa_subaccounttitle/(:any)/(:any)'] = 'pages/delete_soa_subaccounttitle/$1/$2';
$route['delete_soa_accounttitle/(:any)'] = 'pages/delete_soa_accounttitle/$1';
$route['update_soa_subaccounttitle'] = 'pages/update_soa_subaccounttitle';
$route['update_soa_accounttitle'] = 'pages/update_soa_accounttitle';
$route['add_soa_subaccounttitle'] = 'pages/add_soa_subaccounttitle';
$route['add_soa_accounttitle'] = 'pages/add_soa_accounttitle';
$route['soa_settings_details/(:any)'] = 'pages/soa_settings_details/$1';
$route['soa_settings'] = 'pages/soa_settings';
$route['remove_excess/(:any)/(:any)']='pages/remove_excess/$1/$2';
$route['post_excess'] = 'pages/post_excess';
$route['hmo_excess/(:any)'] = 'pages/hmo_excess/$1';
$route['daily_discharged_dialysis_summary'] = 'pages/daily_discharged_dialysis_summary';
$route['daily_discharged_dialysis'] = 'pages/daily_discharged_dialysis';
$route['daily_discharged_inpatient_summary'] = 'pages/daily_discharged_inpatient_summary';
$route['daily_discharged_inpatient'] = 'pages/daily_discharged_inpatient';
$route['hmo_price_list'] = 'pages/hmo_price_list';
$route['arpatient_billing/(:any)/(:any)/(:any)'] = 'pages/arpatient_billing/$1/$2/$3';
$route['daily_admission_ar_hmo_billing_summary'] = 'pages/daily_admission_ar_hmo_billing_summary';
$route['daily_admission_ar_hmo_billing_excel'] = 'pages/daily_admission_ar_hmo_billing_excel';
$route['daily_admission_ar_hmo_billing'] = 'pages/daily_admission_ar_hmo_billing';
$route['hmoreopen'] = 'pages/hmoreopen';
$route['hmofinalize'] = 'pages/hmofinalize';
$route['print_soa_beta/(:any)/(:any)'] = 'pages/print_soa_beta/$1/$2';
$route['print_soa/(:any)/(:any)'] = 'pages/print_soa/$1/$2';
$route['add_hmo_pf'] = 'pages/add_hmo_pf';
$route['delete_hmo_price/(:any)/(:any)'] = 'pages/delete_hmo_price/$1/$2';
$route['save_hmo_price'] = 'pages/save_hmo_price';
$route['search_discharged_patient'] = 'pages/search_discharged_patient';
$route['discharged_patient'] = 'pages/discharged_patient';
$route['search_archive'] = 'pages/search_archive';
$route['search_archive_patient'] = 'pages/search_archive_patient';
$route['details_hmo/(:any)/(:any)'] = 'pages/details_hmo/$1/$2';
$route['view_profile/(:any)'] = 'pages/view_profile/$1';
$route['view_walkin_hmo/(:any)/(:any)/(:any)'] = 'pages/view_walkin_hmo/$1/$2/$3';
$route['delete_charges/(:any)/(:any)/(:any)'] = 'pages/delete_charges/$1/$2/$3';
$route['hmo_charges/(:any)/(:any)'] = 'pages/hmo_charges/$1/$2';
$route['search_arpatient_list'] = 'pages/search_arpatient_list';
$route['arpatient_list'] = 'pages/arpatient_list';
$route['save_pf_discount'] = 'pages/save_pf_discount';
$route['remove_pf_allocation/(:any)/(:any)'] = 'pages/remove_pf_allocation/$1/$2';
$route['pf_allocation/(:any)'] = 'pages/pf_allocation/$1';
$route['daily_admission_walkin_hmo'] = 'pages/daily_admission_walkin_hmo';
$route['daily_admission_ipd_hmo'] = 'pages/daily_admission_ipd_hmo';
$route['daily_admission_ar_hmo'] = 'pages/daily_admission_ar_hmo';
$route['daily_admission_ar_employee'] = 'pages/daily_admission_ar_employee';
$route['print_quotation/(:any)/(:any)'] = 'pages/print_quotation/$1/$2';
$route['remove_quote_item/(:any)/(:any)/(:any)'] = 'pages/remove_quote_item/$1/$2/$3';
$route['quotation_view/(:any)/(:any)'] = 'pages/quotation_view/$1/$2';
$route['quotation_list'] = 'pages/quotation_list';
$route['new_patient_quotation'] = 'pages/new_patient_quotation';
$route['search_quotation'] = 'pages/search_quotation';
$route['quotation'] = 'pages/quotation';
$route['remove_assistance/(:any)/(:any)']='pages/remove_assistance/$1/$2';
$route['save_assistance_pf']='pages/save_assistance_pf';
$route['save_assistance']='pages/save_assistance';
$route['hmo_assistance/(:any)'] = 'pages/hmo_assistance/$1';
$route['remove_allocation_all/(:any)'] = 'pages/remove_allocation_all/$1';
$route['remove_allocation_pf/(:any)/(:any)'] = 'pages/remove_allocation_pf/$1/$2';
$route['remove_allocation/(:any)/(:any)'] = 'pages/remove_allocation/$1/$2';
$route['save_allocation_pf'] = 'pages/save_allocation_pf';
$route['save_allocation'] = 'pages/save_allocation';
$route['hmo_allocation/(:any)'] = 'pages/hmo_allocation/$1';
$route['admit_opdprocedure'] = 'pages/admit_opdprocedure';
//=================================================================================================
//===============================Dialysis Routes===================================================
$route['hospital_charges/(:any)/(:any)'] = 'pages/hospital_charges/$1/$2';
$route['rdu_discharged/(:any)'] = 'pages/rdu_discharged/$1';
$route['patient_discharged'] = 'pages/patient_discharged';
$route['remove_gl_posting/(:any)/(:any)/(:any)'] = 'pages/remove_gl_posting/$1/$2/$3';
$route['save_gl_posting'] = 'pages/save_gl_posting';
$route['gl_allocation/(:any)/(:any)'] = 'pages/gl_allocation/$1/$2';
$route['view_guarantee_letter/(:any)/(:any)'] = 'pages/view_guarantee_letter/$1/$2';
$route['save_gl'] = 'pages/save_gl';
$route['manage_guarantee_letter/(:any)'] = 'pages/manage_guarantee_letter/$1';
$route['search_guarantee_letter'] = 'pages/search_guarantee_letter';
$route['guarantee_letter'] = 'pages/guarantee_letter';
$route['for_transmittal'] = 'pages/for_transmittal';
$route['consoldetails/(:any)'] = 'pages/consoldetails/$1';
$route['stock_on_hand_rdu'] = 'pages/stock_on_hand_rdu';
$route['inventory_reports'] = 'pages/inventory_reports';
$route['activate_account'] = 'pages/activate_account';
$route['search_patient_record_search_rdu'] = 'pages/search_patient_record_search_rdu';
$route['search_patient_record_rdu'] = 'pages/search_patient_record_rdu';
$route['rdureadmission'] = 'pages/rdureadmission';
$route['search_rdulist'] = 'pages/search_rdu_list';
$route['rdu_list'] = 'pages/rdu_list';
$route['rduadmission'] = 'pages/rduadmission';
//=================================================================================================
//===============================Dietary Routes====================================================
$route['delete_charged_item/(:any)/(:any)'] = 'pages/delete_charged_item/$1/$2';
$route['add_charge_item'] = 'pages/add_charge_item';
$route['meal_monitoring_sheet'] = 'pages/meal_monitoring_sheet';
$route['diet_master_list'] = 'pages/masterlist_print';
$route['meal_served'] = 'pages/meal_served';
$route['serve_meal'] = 'pages/serve_meal';
$route['meal_monitoring'] = 'pages/meal_monitoring';
$route['pf_report'] = 'pages/pf_report';
$route['print_diet_tag_all'] = 'pages/print_diet_tag_all';
$route['print_diet_tag/(:any)'] = 'pages/print_diet_tag/$1';
$route['add_diet'] = 'pages/add_diet';
$route['patient_list_view_details/(:any)'] = 'pages/patient_list_view_details/$1';
$route['search_patient_list_view'] = 'pages/search_patient_list_view';
$route['patient_list_view'] = 'pages/patient_list_view';
//=================================================================================================
//================================MedREcords Routes================================================
$route['update_final_diag'] = 'pages/update_final_diag';
$route['printMedLegalPreview/(:any)/(:any)/(:any)'] = 'pages/printMedLegalPreview/$1/$2/$3';
$route['printConfineCertPreview/(:any)/(:any)/(:any)'] = 'pages/printConfineCertPreview/$1/$2/$3';
$route['printClinicalAbsPreview/(:any)/(:any)/(:any)'] = 'pages/printClinicalAbsPreview/$1/$2/$3';
$route['printMedAbsPreview/(:any)/(:any)/(:any)'] = 'pages/printMedAbsPreview/$1/$2/$3';
$route['printMedCertPreview/(:any)/(:any)/(:any)'] = 'pages/printMedCertPreview/$1/$2/$3';
$route['add_icd'] = 'pages/add_icd';
$route['view_chart/(:any)'] = 'pages/view_chart/$1';
$route['delete_chart/(:any)/(:any)/(:any)'] = 'pages/delete_chart/$1/$2/$3';
$route['upload_chart'] = 'pages/upload_chart';
$route['photocopy'] = 'pages/photocopy';
$route['issue_second_copy_others'] = 'pages/issue_second_copy_others';
$route['issue_second_copy_lab/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'pages/issue_second_copy_lab/$1/$2/$3/$4/$5';
$route['issue_second_copy/(:any)/(:any)/(:any)/(:any)'] = 'pages/issue_second_copy/$1/$2/$3/$4';
$route['print_certificate_forward/(:any)/(:any)'] = 'pages/print_certificate_forward/$1/$2';
$route['forward_documents'] = 'pages/forward_documents';
$route['view_documents'] = 'pages/view_documents';
$route['logout_case/(:any)/(:any)'] = 'pages/logout_case/$1/$2';
$route['remove_emr/(:any)/(:any)/(:any)'] = 'pages/remove_emr/$1/$2/$3';
$route['tag_emr'] = 'pages/tag_emr';
$route['top_diseases'] = 'pages/top_diseases';
$route['create_hrn/(:any)'] = 'pages/getHRN/$1';
$route['index_card/(:any)'] = 'pages/index_card/$1';
$route['discharge_patient'] = 'pages/discharge_patient';
$route['reopen'] = 'pages/reopen';
$route['patient_list'] = 'pages/patient_list';
$route['course_ward_compliance'] = 'pages/course_ward_compliance';
$route['expired_admission'] = 'pages/expired_admission';
$route['baby_admission'] = 'pages/baby_admission';
$route['daily_admission_list'] = 'pages/daily_admission_list';
$route['issue_document/(:any)/(:any)/(:any)/(:any)'] = 'pages/issue_document/$1/$2/$3/$4';
$route['delete_document/(:any)/(:any)/(:any)/(:any)'] = 'pages/delete_document/$1/$2/$3/$4';
$route['update_certificate'] = 'pages/update_certificate';
$route['create_certificate'] = 'pages/create_certificate';
$route['printMedLegal/(:any)/(:any)/(:any)'] = 'pages/printMedLegal/$1/$2/$3';
$route['printConfineCert/(:any)/(:any)/(:any)'] = 'pages/printConfineCert/$1/$2/$3';
$route['printClinicalAbs/(:any)/(:any)/(:any)'] = 'pages/printClinicalAbs/$1/$2/$3';
$route['printMedAbs/(:any)/(:any)/(:any)'] = 'pages/printMedAbs/$1/$2/$3';
$route['printMedCert/(:any)/(:any)/(:any)'] = 'pages/printMedCert/$1/$2/$3';
$route['documents/(:any)/(:any)/(:any)'] = 'pages/documents/$1/$2/$3';
$route['medsupview/(:any)/(:any)/(:any)'] = 'pages/medsupview/$1/$2/$3';
$route['testresultview/(:any)/(:any)/(:any)'] = 'pages/testresultview/$1/$2/$3';
$route['printCF3/(:any)'] = 'pages/printCF3/$1';
$route['update_attending_doctor_mrd'] = 'pages/update_attending_doctor_mrd';
$route['update_disposition'] = 'pages/update_disposition';
$route['remove_diagnosis/(:any)/(:any)/(:any)'] = 'pages/remove_diagnosis/$1/$2/$3';
$route['search_add_diagnosis'] = 'pages/search_add_diagnosis';
$route['update_diagnosis'] = 'pages/update_diagnosis';
$route['save_diagnosis'] = 'pages/save_diagnosis';
$route['add_diagnosis/(:any)/(:any)'] = 'pages/add_diagnosis/$1/$2';
$route['manage_diagnosis/(:any)/(:any)'] = 'pages/manage_diagnosis/$1/$2';
$route['update_discharged_date_time'] = 'pages/update_discharged_date_time';
//================================MedRecords Routes================================================
//================================SCM Routes======================================
$route['list_of_items'] = 'pages/list_of_items';
$route['request_history'] = 'pages/request_history';
$route['change_dept/(:any)'] = 'pages/change_dept/$1';
$route['near_expiry'] = 'pages/near_expiry';
$route['print_charge_bod/(:any)/(:any)/(:any)'] = 'pages/print_charge_bod/$1/$2/$3';
$route['update_bod_price'] = 'pages/update_bod_price';
$route['weekly_invoice_report'] = 'pages/weekly_invoice_report';
$route['critical_level'] = 'pages/critical_level';
$route['save_reorder_level'] = 'pages/save_reorder_level';
$route['edit_invoice'] = 'pages/edit_invoice';
$route['print_index_card/(:any)'] = 'pages/print_index_card/$1';
$route['print_return/(:any)'] = 'pages/print_return/$1';
$route['item_returns'] = 'pages/item_returns';
$route['preview_return/(:any)'] = 'pages/preview_return/$1';
$route['postreturnsupplier'] = 'pages/postreturnsupplier';
$route['returnremoveitem/(:any)'] = 'pages/returnremoveitem/$1';
$route['returnadditem'] = 'pages/returnadditem';
$route['manage_return_search'] = 'pages/manage_return_search';
$route['manage_return'] = 'pages/manage_return';
$route['update_return'] = 'pages/update_return';
$route['create_return'] = 'pages/create_return';
$route['return_to_supplier'] = 'pages/return_to_supplier';
$route['return_print/(:any)'] = 'pages/return_print/$1';
$route['department_return_history'] = 'pages/department_return_history';
$route['cancel_return_view/(:any)/(:any)'] = 'pages/cancel_return_view/$1/$2';
$route['return_item'] = 'pages/return_item';
$route['cancel_return/(:any)'] = 'pages/cancel_return/$1';
$route['view_returns/(:any)'] = 'pages/view_returns/$1';
$route['department_return'] = 'pages/department_return';
$route['bodremoveitem/(:any)'] = 'pages/bodremoveitem/$1';
$route['postchargebod/(:any)'] = 'pages/postchargebod/$1';
$route['bodadditem'] = 'pages/bodadditem';
$route['new_charge_to_bod'] = 'pages/new_charge_to_bod';
$route['manage_charge'] = 'pages/manage_charge';
$route['create_charge'] = 'pages/create_charge';
$route['search_charge_to_bod'] = 'pages/search_charge_to_bod';
$route['charge_to_bod'] = 'pages/charge_to_bod';
$route['save_production_os'] = 'pages/save_production_os';
$route['save_production_alcohol'] = 'pages/save_production_alcohol';
$route['save_production_gloves'] = 'pages/save_production_gloves';
$route['item_production'] = 'pages/item_production';
$route['remove_kit_item/(:any)/(:any)/(:any)'] = 'pages/remove_kit_item/$1/$2/$3';
$route['add_kit_item'] = 'pages/add_kit_item';
$route['add_kit_items/(:any)/(:any)'] = 'pages/add_kit_items/$1/$2';
$route['add_kit_quantity'] = 'pages/add_kit_quantity';
$route['save_kit_assembly'] = 'pages/save_kit_assembly';
$route['search_kit_assembly'] = 'pages/search_kit_assembly';
$route['kit_assembly'] = 'pages/kit_assembly';
$route['delete_supplier/(:any)'] = 'pages/delete_supplier/$1';
$route['save_supplier'] = 'pages/save_supplier';
$route['manage_supplier'] = 'pages/manage_supplier';
$route['update_supplies'] = 'pages/update_supplies';
$route['add_supplies'] = 'pages/add_supplies';
$route['manage_supplies'] = 'pages/manage_supplies';
$route['update_medicine'] = 'pages/update_medicine';
$route['add_medicine'] = 'pages/add_medicine';
$route['manage_medicine'] = 'pages/manage_medicine';
$route['price_review'] = 'pages/price_review';
$route['validate_save'] = 'pages/validate_save';
$route['search_validate'] = 'pages/search_validate';
$route['validate'] = 'pages/validate';
$route['validation'] = 'pages/validation';
$route['count_sheet_view'] = 'pages/count_sheet_view';
$route['count_sheet_print'] = 'pages/count_sheet_print';
$route['count_sheet'] = 'pages/count_sheet';
$route['search_stock_on_hand'] = 'pages/search_stock_on_hand';
$route['stock_on_hand'] = 'pages/stock_on_hand';
$route['adjust_item'] = 'pages/adjust_item';
$route['search_adjusting_entry'] = 'pages/search_adjusting_entry';
$route['authenticate_adjustment'] = 'pages/authenticate_adjustment';
$route['adjusting_entry'] = 'pages/adjusting_entry';
$route['view_stock_card'] = 'pages/view_stock_card';
$route['stock_card'] = 'pages/stock_card';
$route['print_kit_assembly_report/(:any)'] = 'pages/print_kit_assembly_report/$1';
$route['kit_assembly_report'] = 'pages/kit_assembly_report';
$route['search_item_price'] = 'pages/search_item_price';
$route['item_price'] = 'pages/item_price';
$route['view_adjustment_history'] = 'pages/view_adjustment_history';
$route['adjustment_history'] = 'pages/adjustment_history';
$route['consolidated_po'] = 'pages/consolidated_po';
$route['receiving_summary'] = 'pages/receiving_summary';
$route['issuance_history_expense'] = 'pages/issuance_history_expense';
$route['issuance_history_charge'] = 'pages/issuance_history_charge';
$route['issuance_history_report'] = 'pages/issuance_history_report';
$route['issuance_history'] = 'pages/issuance_history';
$route['receiving_history_details'] = 'pages/receiving_history_details';
$route['receiving_history_supplier_details'] = 'pages/receiving_history_supplier_details';
$route['receiving_history_supplier'] = 'pages/receiving_history_supplier';
$route['receiving_history'] = 'pages/receiving_history';
$route['search_charge_slip'] = 'pages/search_charge_slip';
$route['charge_slip'] = 'pages/charge_slip';
$route['print_transfer/(:any)'] = 'pages/print_transfer/$1';
$route['post_transfer/(:any)'] = 'pages/post_transfer/$1';
$route['preview_transfer/(:any)'] = 'pages/preview_transfer/$1';
$route['update_transfer_item'] = 'pages/update_transfer_item';
$route['remove_transfer_item/(:any)'] = 'pages/remove_transfer_item/$1';
$route['transferadditem'] = 'pages/transferadditem';
$route['stock_transfer_new'] = 'pages/stock_transfer_new';
$route['create_transfer'] = 'pages/create_transfer';
$route['stock_transfer'] = 'pages/stock_transfer';
$route['cancel_stock_issuance/(:any)/(:any)/(:any)'] = 'pages/cancel_stock_issuance/$1/$2/$3';
$route['cancel_issuance/(:any)'] = 'pages/cancel_issuance/$1';
$route['print_stock_issuance_detailed_copy/(:any)/(:any)/(:any)/(:any)'] = 'pages/print_stock_issuance_detailed_copy/$1/$2/$3/$4';
$route['print_stock_issuance_detailed/(:any)/(:any)/(:any)/(:any)'] = 'pages/print_stock_issuance_detailed/$1/$2/$3/$4';
$route['print_stock_issuance/(:any)'] = 'pages/print_stock_issuance/$1';
$route['post_stock_issuance'] = 'pages/post_stock_issuance';
$route['manage_stock_issuance/(:any)/(:any)'] = 'pages/manage_stock_issuance/$1/$2';
$route['view_stock_issuance/(:any)'] = 'pages/view_stock_issuance/$1';
$route['stock_issuance'] = 'pages/stock_issuance';
$route['po_print_monitoring/(:any)'] = 'pages/po_print_monitoring/$1';
$route['po_monitoring'] = 'pages/po_monitoring';
$route['post_manual_receiving/(:any)'] = 'pages/post_manual_receiving/$1';
$route['update_manual_item'] = 'pages/update_manual_item';
$route['preview_manual_receiving/(:any)'] = 'pages/preview_manual_receiving/$1';
$route['remove_manual_item/(:any)'] = 'pages/remove_manual_item/$1';
$route['manualpoadditem'] = 'pages/manualpoadditem';
$route['manage_manual_receiving'] = 'pages/manage_manual_receiving';
$route['create_receiving'] = 'pages/create_receiving';
$route['manual_receiving'] = 'pages/manual_receiving';
$route['receiving_add_batch'] = 'pages/receiving_add_batch';
$route['receiving_add_free_goods'] = 'pages/receiving_add_free_goods';
$route['change_supplier'] = 'pages/change_supplier';
$route['rr_print/(:any)/(:any)'] = 'pages/rr_print/$1/$2';
$route['post_receiving'] = 'pages/post_receiving';
$route['preview_receiving/(:any)/(:any)'] = 'pages/preview_receiving/$1/$2';
$route['manage_receiving/(:any)'] = 'pages/manage_receiving/$1';
$route['purchase_receiving'] = 'pages/purchase_receiving';
$route['update_requested_item'] = 'pages/update_requested_item';
$route['update_receive_item'] = 'pages/update_receive_item';
$route['pr_study/(:any)'] = 'pages/pr_study/$1';
$route['pr_print/(:any)'] = 'pages/pr_print/$1';
$route['po_print/(:any)'] = 'pages/po_print/$1';
$route['remove_requested_item/(:any)'] = 'pages/remove_requested_item/$1';
$route['poadditem'] = 'pages/poadditem';
$route['manage_purchase_request'] = 'pages/manage_purchase_request';
$route['manage_request/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'pages/manage_request/$1/$2/$3/$4/$5/$6';
$route['create_request'] = 'pages/create_request';
$route['purchase_request'] = 'pages/purchase_request';
//================================================================================
$route['ob_reports'] = 'pages/ob_reports';
$route['remove_room/(:any)/(:any)'] = 'pages/remove_room/$1/$2';
$route['manage_room_admit/(:any)'] = 'pages/manage_room_admit/$1';
$route['save_initial_diag'] = 'pages/save_initial_diag';
$route['dischargedlist'] = 'pages/dischargedlist';
$route['update_opd_membership'] = 'pages/update_opd_membership';
$route['referred_summary'] = 'pages/referred_summary';
$route['admission_patient_list'] = 'pages/admission_patient_list';
$route['summary_chart/(:any)'] = 'pages/summary_chart/$1';
$route['cancel_opd_admission/(:any)'] = 'pages/cancel_opd_admission/$1';
$route['save_credit_limit'] = 'pages/save_credit_limit';
$route['save_vital_signs'] = 'pages/save_vital_signs';
$route['delete_doctor_account/(:any)/(:any)'] = 'pages/delete_doctor_account/$1/$2';
$route['update_doctor_access'] = 'pages/update_doctor_access';
$route['update_doctor_account'] = 'pages/update_doctor_account';
$route['add_doctor_access'] = 'pages/add_doctor_access';
$route['manage_doctor_account/(:any)'] = 'pages/manage_doctor_account/$1';
$route['delete_autocharge/(:any)'] = 'pages/delete_autocharge/$1';
$route['save_autocharge'] = 'pages/save_autocharge';
$route['manage_autocharge'] = 'pages/manage_autocharge';
$route['delete_accounttitle/(:any)'] = 'pages/delete_accounttitle/$1';
$route['save_accounttitle'] = 'pages/save_accounttitle';
$route['manage_accounttitle'] = 'pages/manage_accounttitle';
$route['delete_nationality/(:any)'] = 'pages/delete_nationality/$1';
$route['save_nationality'] = 'pages/save_nationality';
$route['manage_nationality'] = 'pages/manage_nationality';
$route['delete_station/(:any)'] = 'pages/delete_station/$1';
$route['save_station'] = 'pages/save_station';
$route['manage_station'] = 'pages/manage_station';
$route['delete_religion/(:any)'] = 'pages/delete_religion/$1';
$route['save_religion'] = 'pages/save_religion';
$route['manage_religion'] = 'pages/manage_religion';
$route['save_address'] = 'pages/save_address';
$route['delete_barangay/(:any)/(:any)/(:any)'] = 'pages/delete_barangay/$1/$2/$3';
$route['save_barangay'] = 'pages/save_barangay';
$route['manage_barangay/(:any)/(:any)'] = 'pages/manage_barangay/$1/$2';
$route['save_city'] = 'pages/save_city';
$route['delete_city/(:any)/(:any)'] = 'pages/delete_city/$1/$2';
$route['manage_city/(:any)'] = 'pages/manage_city/$1';
$route['delete_province/(:any)'] = 'pages/delete_province/$1';
$route['manage_address'] = 'pages/manage_address';
$route['delete_others/(:any)'] = 'pages/delete_others/$1';
$route['save_others'] = 'pages/save_others';
$route['manage_others'] = 'pages/manage_others';
$route['delete_diagnostic/(:any)'] = 'pages/delete_diagnostic/$1';
$route['save_diagnostics'] = 'pages/save_diagnostics';
$route['manage_diagnostics'] = 'pages/manage_diagnostics';
$route['delete_hmo/(:any)'] = 'pages/delete_hmo/$1';
$route['save_hmo'] = 'pages/save_hmo';
$route['fetch_single_hmo'] = 'pages/fetch_single_hmo';
$route['manage_hmo'] = 'pages/manage_hmo';
$route['change_room_status/(:any)/(:any)/(:any)'] = 'pages/change_room_status/$1/$2/$3';
$route['save_room'] = 'pages/save_room';
$route['fetch_single_room'] = 'pages/fetch_single_room';
$route['view_room_search'] = 'pages/view_room_search';
$route['view_rooms/(:any)'] = 'pages/view_rooms/$1';
$route['manage_rooms'] = 'pages/manage_rooms';
$route['save_doctor'] = 'pages/save_doctor';
$route['update_user_access'] = 'pages/update_user_access';
$route['delete_station_account/(:any)/(:any)'] = 'pages/delete_station_account/$1/$2';
$route['add_employee_access'] = 'pages/add_employee_access';
$route['update_user_account'] = 'pages/update_user_account';
$route['fetch_single_employee'] = 'pages/fetch_single_employee';
$route['manage_employee_account/(:any)'] = 'pages/manage_employee_account/$1';
$route['save_employee'] = 'pages/save_employee';
$route['fetch_single_employee'] = 'pages/fetch_single_employee';
$route['manage_search_doctors'] = 'pages/manage_search_doctors';
$route['manage_doctors'] = 'pages/manage_doctors';
$route['manage_employees'] = 'pages/manage_employees';
$route['patient_merging'] = 'pages/patient_merging';
$route['walkinreadmission'] = 'pages/walkinreadmission';
$route['walkinadmission'] = 'pages/walkinadmission';
$route['opd_minor_report'] = 'pages/opd_minor_report';
$route['rod_reports'] = 'pages/rod_reports';
$route['daily_admission_opd'] = 'pages/daily_admission_opd';
$route['opdreadmission'] = 'pages/opdreadmission';
$route['opdadmission'] = 'pages/opdadmission';
$route['update_admitting_doctor'] = 'pages/update_admitting_doctor';
$route['searchopdlist'] = 'pages/searchopdlist';
$route['opdlist'] = 'pages/opdlist';
$route['fetch_single_address'] = 'pages/fetch_single_address';
$route['updatepatientaddress'] = 'pages/updatepatientaddress';
$route['fetch_single_admission'] = 'pages/fetch_single_admission';
$route['view_patient_record_details/(:any)/(:any)'] = 'pages/view_patient_record_details/$1/$2';
$route['fetchSinglePatient'] = 'pages/fetchSinglePatient';
$route['view_patient_record/(:any)'] = 'pages/view_patient_record/$1';
$route['search_patient_record_search'] = 'pages/search_patient_record_search';
$route['search_patient_record'] = 'pages/search_patient_record';
$route['updatepatientprofile'] = 'pages/updatepatientprofile';
$route['patientprofile/(:any)'] = 'pages/patientprofile/$1';
$route['set_status_occupied/(:any)'] = 'pages/set_status_occupied/$1';
$route['set_status_vacant/(:any)'] = 'pages/set_status_vacant/$1';
$route['room_status'] = 'pages/room_status';
$route['set_rod/(:any)'] = 'pages/set_rod/$1';
$route['rod_manager'] = 'pages/rod_manager';
$route['daily_discharged'] = 'pages/daily_discharged';
$route['daily_admission'] = 'pages/daily_admission';
$route['remove_item_request/(:any)'] = 'pages/remove_item_request/$1';
$route['fetch_single_item'] = 'pages/fetch_single_item';
$route['requestadditem'] = 'pages/requestadditem';
$route['stock_request_cancel/(:any)'] = 'pages/stock_request_cancel/$1';
$route['stock_request_new'] = 'pages/stock_request_new';
$route['stock_request_print/(:any)'] = 'pages/stock_request_print/$1';
$route['stock_request'] = 'pages/stock_request';
$route['return_dept/(:any)'] = 'pages/return_dept/$1';
$route['discharged_summary'] = 'pages/discharged_summary';
$route['arhmo_billing_report'] = 'pages/arhmo_billing_report';
$route['patient_deposit_report'] = 'pages/patient_deposit_report';
$route['view_patient_deposit'] = 'pages/view_patient_deposit';
$route['patient_deposit/(:any)/(:any)/(:any)'] = 'pages/patient_deposit/$1/$2/$3';
$route['arhmo_billing/(:any)/(:any)/(:any)'] = 'pages/arhmo_billing/$1/$2/$3';
$route['discharged_report/(:any)/(:any)/(:any)'] = 'pages/discharged_report/$1/$2/$3';
$route['report_portal/(:any)/(:any)/(:any)'] = 'pages/report_portal/$1/$2/$3';
$route['request_stock/(:any)/(:any)/(:any)'] = 'pages/request_stock/$1/$2/$3';
$route['discharge_opd_admission/(:any)'] = 'pages/discharge_opd_admission/$1';
$route['discharge_ar_admission/(:any)'] = 'pages/discharge_ar_admission/$1';
$route['update_ar_attending_doctor'] = 'pages/update_ar_attending_doctor';
$route['cover_sheet/(:any)'] = 'pages/cover_sheet/$1';
$route['save_admission_hmo_allocation'] = 'pages/save_admission_hmo_allocation';
$route['save_admission_hmo_procedure'] = 'pages/save_admission_hmo_procedure';
$route['save_admission_hmo_ar'] = 'pages/save_admission_hmo_ar';
$route['save_admission_hmo'] = 'pages/save_admission_hmo';
$route['save_admission_change_room'] = 'pages/save_admission_change_room';
$route['update_attending_doctor'] = 'pages/update_attending_doctor';
$route['fetch_single_doctor'] = 'pages/fetch_single_doctor';
$route['update_admission_details'] = 'pages/update_admission_details';
$route['cancel_admission/(:any)/(:any)'] = 'pages/cancel_admission/$1/$2';
$route['search_arlist'] = 'pages/search_arlist';
$route['search_ipdlist'] = 'pages/search_ipdlist';
$route['admit_arlist'] = 'pages/admit_arlist';
$route['admit_ipdlist'] = 'pages/admit_ipdlist';
$route['checkHCNExist'] = 'pages/checkHCNExist';
$route['checkPassword'] = 'pages/checkPassword';
$route['submitadmission'] = 'pages/submitadmission';
$route['arreadmission'] = 'pages/arreadmission';
$route['aradmission'] = 'pages/aradmission';
$route['ipdreadmission'] = 'pages/ipdreadmission';
$route['ipdadmission'] = 'pages/ipdadmission';
$route['fetch_previous_admission'] = 'pages/fetch_previous_admission';
$route['getZipCode'] = 'pages/getZipCode';
$route['getBarangay'] = 'pages/getBarangay';
$route['getCity'] = 'pages/getCity';
$route['search_arlist'] = 'pages/search_arlist';
$route['search_ipdlist'] = 'pages/search_ipdlist';
$route['search_admission'] = 'pages/search_admission';
$route['admission'] = 'pages/admission';
$route['main'] = 'pages/main';
$route['logout'] = 'pages/logout';
$route['authenticate'] = 'pages/authenticate';
$route['request_login'] = 'pages/request_login';
$route['default_controller'] = 'pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['bridge/(:any)'] = 'pages/bridge/$1';
