<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CNFBilling extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			$this->data['page_title'] = 'CNF Billing';

			if ($this->session->userdata('usergroup') == 1) {
				$custdata = $this->am->getCNFBillingList(null, TRUE);
			} else if ($this->session->userdata('usergroup') == 2) {
				$custdata = $this->am->getCNFBillingList(array('cnf_user_id' => $this->session->userdata('userid')), TRUE);
			} else if ($this->session->userdata('usergroup') == 3) {
				$custdata = $this->am->getCNFBillingList(array('dealer_user_id' => $this->session->userdata('userid')), TRUE);
			} else {
				$custdata = [];
			}

			if (!empty($custdata)) {
				foreach ($custdata as $key => $value) {
					$cnf_user = $this->am->getUserData(array('user_id' => $value->cnf_user_id));
					$this->data['comp_data'][] = array(
						'dtime'  => $value->added_dtime,
						'rwid'  => encode_url($value->billing_id),
						'name'  => $value->name,
						'vin_no'  => $value->vin_no,
						'dealer_full_name'  => $value->dealer_full_name,
						'cnf_full_name'  => (!empty($cnf_user)) ? $cnf_user->full_name : '',
						'added_by'  => $value->cnf_user_id,
						'edited_dtime'  => ($value->edited_dtime != '') ? $value->edited_dtime : 'NA'
					);
				}

				//print_obj($this->data['comp_data']);die;

			} else {
				$this->data['comp_data'] = '';
			}
			$this->load->view('cnfbilling/vw_list', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onCheckDuplicate()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$name = xss_clean($this->input->post('name'));

				$if_exists = $this->am->getCNFEntryData(array('company_name' => $name), FALSE);
				if ($if_exists) {
					$return['if_exists'] = 1;
				} else {
					$return['if_exists'] = 0;
				}

				header('Content-Type: application/json');

				echo json_encode($return);
			} else {
				//exit('No direct script access allowed');
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function onGetEdit()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'Edit CNF Billing';
			$entry_id = decode_url(xss_clean($this->uri->segment(3)));
			$chkdata = array(
				'entry_id'  => $entry_id
			);
			$getdata = $this->am->getCNFEntryData($chkdata, FALSE);
			if ($getdata) {
				$this->data['comp_data'] = array(
					'dtime'  => $getdata->added_dtime,
					'rwid'  => encode_url($getdata->entry_id),
					'name'  => $getdata->name,
					'et_invoice_no'  => $getdata->et_invoice_no,
					'et_invoice_date'  => $getdata->et_invoice_date,
					'model'  => $getdata->model,
					'color'  => $getdata->color,
					'vin_no'  => $getdata->vin_no,
					'motor_no'  => $getdata->motor_no,
					'converter_no'  => $getdata->converter_no,
					'controller_no'  => $getdata->controller_no,
					'charger_no'  => $getdata->charger_no,
					'status'  => $getdata->status,
					'added_by'  => $getdata->added_by,
					'edited_dtime'  => ($getdata->edited_dtime != '') ? $getdata->edited_dtime : 'NA'
				);
				//print_obj($this->data['comp_data']);die;
				$this->load->view('cnfbilling/vw_edit', $this->data, false);
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function onChange()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'CNF Billing';
			$entry_id = decode_url(xss_clean($this->input->post('rw_id')));
			$chkdata = array('entry_id'  => $entry_id);

			$name = xss_clean($this->input->post('name'));
			$et_invoice_no = xss_clean($this->input->post('et_invoice_no'));
			$et_invoice_date = xss_clean($this->input->post('et_invoice_date'));
			$model = xss_clean($this->input->post('model'));
			$color = xss_clean($this->input->post('color'));
			$vin_no = xss_clean($this->input->post('vin_no'));
			$motor_no = xss_clean($this->input->post('motor_no'));
			$converter_no = xss_clean($this->input->post('converter_no'));
			$controller_no = xss_clean($this->input->post('controller_no'));
			$charger_no = xss_clean($this->input->post('charger_no'));
			$battery_sl1 = xss_clean($this->input->post('battery_sl1'));

			// print_obj($upd_userdata);die;

			$custdata = $this->am->getCNFEntryData($chkdata, FALSE);
			if (!empty($custdata)) {
				//update

				$upd_data = array(
					'name'  => $name,
					'et_invoice_no'  => $et_invoice_no,
					'et_invoice_date'  => $et_invoice_date,
					'model'  => $model,
					'color'  => $color,
					'vin_no'  => $vin_no,
					'motor_no'  => $motor_no,
					'converter_no'  => $converter_no,
					'controller_no'  => $controller_no,
					'charger_no'  => $charger_no,
					'edited_dtime'  => dtime,
					'edited_by'  => $this->session->userdata('userid')
				);

				$upduser = $this->am->updateCNFEntry($upd_data, $chkdata);

				redirect(base_url('cnfbilling/edit/' . encode_url($entry_id)));
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function onCreateView()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'CNF Billing';

			if ($this->session->userdata('usergroup') == 1) {
				$bikedata = $this->am->getCNFEntryData(array('status' => 1, 'is_billed' => 0), TRUE);
			} else if ($this->session->userdata('usergroup') == 2) {
				$bikedata = $this->am->getCNFEntryData(array('status' => 1, 'is_billed' => 0, 'added_by' => $this->session->userdata('userid')), TRUE);
			}
			// else if ($this->session->userdata('usergroup') == 3) {
			// 	$custdata = $this->am->getCNFBillingList(array('dealer_user_id' => $this->session->userdata('userid')), TRUE);
			// }
			else {
				$bikedata = [];
			}



			if (!empty($bikedata)) {
				foreach ($bikedata as $key => $value) {
					$this->data['bike_data'][] = array(
						'dtime'  => $value->added_dtime,
						'rwid'  => encode_url($value->entry_id),
						'name'  => $value->vin_no,
						'status'  => $value->status,
						'added_by'  => $value->added_by,
						'edited_dtime'  => ($value->edited_dtime != '') ? $value->edited_dtime : 'NA'
					);
				}

				//print_obj($this->data['bike_data']);die;

			} else {
				$this->data['bike_data'] = '';
			}


			if ($this->session->userdata('usergroup') == 2) {
				$userdata = $this->am->getUserData(array('parent_id' => $this->session->userdata('userid'), 'user_group' => 3), TRUE);
			} else {
				$userdata = $this->am->getUserData(array('user_id !=' => 1, 'user_group' => 3), TRUE);
			}


			if ($userdata) {
				foreach ($userdata as $key => $value) {
					$this->data['user_data'][] = array(
						'dtime'  => $value->dtime,
						'userid'  => encode_url($value->user_id),
						'usergroup'  => $value->user_group,
						'username'  => $value->user_name,
						//'password'  => decrypt_it($value->pass),
						'fullname'  => $value->full_name,
						'lastlogin'  => $value->last_login,
						'lastloginip'  => $value->last_login_ip,
						'lastupdated'  => $value->last_updated
					);
				}

				//print_obj($this->data['user_data']);die;

			} else {
				$this->data['user_data'] = '';
			}

			$this->load->view('cnfbilling/vw_add', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onCreate()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$this->form_validation->set_rules('cnf_entry_id_1', 'VIN No', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('dealer_user_id_1', 'Choose Dealer', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('cnf_notes_1', 'CNF Notes', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('amount_1', 'Amount', 'trim|required|numeric|xss_clean|htmlentities');
				$this->form_validation->set_rules('gst_per', 'GST %', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('discount', 'Discount', 'trim|required|numeric|xss_clean|htmlentities');

				if ($this->form_validation->run() == FALSE) {
					$this->form_validation->set_error_delimiters('', '');
					$return['errors'] = validation_errors();
					$return['added'] = 'rule_error';
				} else {
					for ($sl = 1; $sl <= 3; $sl++) {
						$cnf_entry_id = decode_url(xss_clean($this->input->post('cnf_entry_id_' . $sl)));
						$dealer_user_id = decode_url(xss_clean($this->input->post('dealer_user_id_' . $sl)));
						$cnf_notes = xss_clean($this->input->post('cnf_notes_' . $sl));
						$rate = xss_clean($this->input->post('amount_' . $sl));
						$gst = xss_clean($this->input->post('gst_per'));
						$discount = xss_clean($this->input->post('discount'));
						$qty = 1;
						$billing_uniqid = 'CNF' . $cnf_entry_id . random_strings(6);

						$chkdata = array('cnf_entry_id'  => $cnf_entry_id);
						$getdata = $this->am->getCNFBillingData($chkdata, FALSE);

						if (!$getdata) {

							$subtotal = $rate * $qty;
							$gst_amt = ($subtotal * $gst) / 100;

							if ($discount > 0) {
								$grand_total = ($subtotal + $gst_amt) - $discount;
							} else {
								$grand_total = ($subtotal + $gst_amt);
							}


							//add
							$ins_data = array(
								'billing_uniqid' => $billing_uniqid,
								'cnf_entry_id'  => $cnf_entry_id,
								'dealer_user_id'  => $dealer_user_id,
								'cnf_notes'  => $cnf_notes,
								'rate'  => $rate,
								'qty'  => $qty,
								'subtotal'  => number_format((float)$subtotal, 2, '.', ''),
								'discount'  => $discount,
								'gst'  => $gst,
								'gst_amt'  => number_format((float)$gst_amt, 2, '.', ''),
								'grand_total'  => number_format((float)$grand_total, 2, '.', ''),
								'added_dtime'  => dtime,
								'cnf_user_id'  => $this->session->userdata('userid')
							);
							// print_obj($ins_data);die;
							$addcust = $this->am->addCNFBilling($ins_data);

							if ($addcust) {

								$upd = $this->am->updateCNFEntry(array(
									'is_billed'  => 1
								), array(
									'entry_id'  => $cnf_entry_id
								));

								$return['added'] = 'success';
							} else {
								$return['added'] = 'failure';
							}
						} else {
							$return['added'] = 'already_exists';
						}
					}
				}

				header('Content-Type: application/json');
				echo json_encode($return);
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function onDelete()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1 && $this->session->userdata('usergroup') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$billing_id  = decode_url(xss_clean($this->input->post('delid')));
				$getdata = $this->am->getCNFBillingData(array('billing_id'  => $billing_id), FALSE);

				if (!empty($getdata)) {
					//del
					$del = $this->am->delCNFBilling(array('billing_uniqid' => $getdata->billing_uniqid));

					if ($del) {
						$upd = $this->am->updateCNFEntry(array(
							'is_billed'  => 0
						), array(
							'entry_id'  => $getdata->cnf_entry_id
						));

						$return['deleted'] = 'success';
					} else {
						$return['deleted'] = 'failure';
					}
				} else {
					$return['deleted'] = 'not_exists';
				}

				header('Content-Type: application/json');
				echo json_encode($return);
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}


	public function onGetInvoice()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'CNF Invoice';
			$billing_id = decode_url(xss_clean($this->uri->segment(3)));
			$chkdata = array(
				'billing_id'  => $billing_id
			);
			$getdata = $this->am->getCNFBillingList($chkdata, FALSE);
			if ($getdata) {
				$this->data['comp_data'] = array(
					'dtime'  => $getdata->added_dtime,
					'rwid'  => encode_url($getdata->entry_id),
					'name'  => $getdata->name,
					'et_invoice_no'  => $getdata->et_invoice_no,
					'et_invoice_date'  => $getdata->et_invoice_date,
					'model'  => $getdata->model,
					'color'  => $getdata->color,
					'vin_no'  => $getdata->vin_no,
					'motor_no'  => $getdata->motor_no,
					'converter_no'  => $getdata->converter_no,
					'controller_no'  => $getdata->controller_no,
					'charger_no'  => $getdata->charger_no,
					'status'  => $getdata->status,
					'added_by'  => $getdata->added_by,
					'edited_dtime'  => ($getdata->edited_dtime != '') ? $getdata->edited_dtime : 'NA'
				);
				print_obj($this->data['comp_data']);
				die;
				$this->load->view('cnfbilling/vw_invoice', $this->data, false);
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}
}
