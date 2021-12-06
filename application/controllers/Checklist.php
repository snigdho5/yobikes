<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checklist extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			$this->data['page_title'] = 'Checklists';
			$getdata = $this->am->getChecklists(array('tbl_checklists.status' => 1), TRUE);
			if (!empty($getdata)) {
				foreach ($getdata as $key => $value) {
					$this->data['list_data'][] = array(
						'dtime'  => $value->added_dtime,
						'checklistid'  => encode_url($value->checklist_id),
						'name'  => $value->checklist_name,
						'cyclename'  => $value->cycle_name,
						'compname'  => $value->company_name,
						'segname'  => $value->segment_name,
						'status'  => $value->status,
						'added_by'  => $value->added_by,
						'edited_dtime'  => ($value->edited_dtime != '') ? $value->edited_dtime : 'NA'
					);
				}

				//print_obj($this->data['list_data']);die;

			} else {
				$this->data['list_data'] = '';
			}
			$this->load->view('checklists/vw_checklist_list', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onCheckDuplicateChecklist()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$name = xss_clean($this->input->post('name'));

				$if_exists = $this->am->getChecklistData(array('checklist_name' => $name), FALSE);
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

	public function getCycle()
	{
		// if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$comp_id = decode_url(xss_clean($this->input->post('comp_id')));
				$seg_id = decode_url(xss_clean($this->input->post('seg_id')));
				$dropdown = '<option value="">Select</option>';

				$cycles = $this->am->getCycleData(array('company_id' => $comp_id, 'segment_id' => $seg_id), TRUE);
				//print_obj($cycles);die;
				if (!empty($cycles)) {
					foreach ($cycles as $key => $value) {

						$dropdown .= '<option value="' . encode_url($value->cycle_id) . '">' . $value->cycle_name . '</option>';
					}

					$return['list'] = $dropdown;
				} else {
					$return['list'] = $dropdown;
				}

				header('Content-Type: application/json');

				echo json_encode($return);
			} else {
				//exit('No direct script access allowed');
				redirect(base_url());
			}
		// } else {
		// 	redirect(base_url());
		// }
	}

	public function getColor()
	{
		// if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$comp_id = decode_url(xss_clean($this->input->post('comp_id')));
				$seg_id = decode_url(xss_clean($this->input->post('seg_id')));
				$cycleid = decode_url(xss_clean($this->input->post('cycleid')));
				$dropdown = '<option value="">Select</option>';

				$colors = $this->am->getChecklistData(array('company_id' => $comp_id, 'segment_id' => $seg_id, 'cycle_id' => $cycleid), TRUE);
				//print_obj($cycles);die;
				if (!empty($colors)) {
					foreach ($colors as $key => $value) {

						$dropdown .= '<option value="' . encode_url($value->checklist_name) . '">' . $value->checklist_name . '</option>';
					}

					$return['list'] = $dropdown;
				} else {
					$return['list'] = $dropdown;
				}

				header('Content-Type: application/json');

				echo json_encode($return);
			} else {
				//exit('No direct script access allowed');
				redirect(base_url());
			}
		// } else {
		// 	redirect(base_url());
		// }
	}

	public function onGetChecklistEdit()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'Edit Checklist';
			$checklist_id = decode_url(xss_clean($this->uri->segment(2)));
			$chkdata = array(
				'checklist_id'  => $checklist_id
			);
			$getdata = $this->am->getChecklists($chkdata, FALSE);
			if (!empty($getdata)) {
				$this->data['edit_data'] = array(
					'dtime'  => $getdata->added_dtime,
					'cycleid'  => encode_url($getdata->cycle_id),
					'cycle_name'  => $getdata->cycle_name,
					'compid'  => encode_url($getdata->company_id),
					'segid'  => encode_url($getdata->segment_id),
					'checklistid'  => encode_url($getdata->checklist_id),
					'name'  => $getdata->checklist_name,
					'quantity'  => $getdata->quantity,
					'carton'  => $getdata->carton,
					'tyre'  => $getdata->tyre,
					'rim'  => $getdata->rim,
					'rim'  => $getdata->rim,
					'busket'  => $getdata->busket,
					'frame'  => $getdata->frame,
					'mudguard'  => $getdata->mudguard,
					'sit'  => $getdata->sit,
					'handle'  => $getdata->handle,
					'carrier'  => $getdata->carrier,
					//'status'  => $getdata->status,
					//'added_by'  => $getdata->added_by,
					//'edited_dtime'  => ($getdata->edited_dtime != '') ? $getdata->edited_dtime : 'NA'
				);
				//print_obj($this->data['edit_data']);die;

				$compdata = $this->am->getCompanyData(array('status' => 1), TRUE);
				if (!empty($compdata)) {
					foreach ($compdata as $key => $value) {
						$this->data['comp_data'][] = array(
							'compid'  => encode_url($value->company_id),
							'name'  => $value->company_name,
						);
					}

					//print_obj($this->data['comp_data']);die;

				} else {
					$this->data['comp_data'] = '';
				}

				$segdata = $this->am->getSegmentData(array('status' => 1), TRUE);
				if (!empty($segdata)) {
					foreach ($segdata as $key => $value) {
						$this->data['seg_data'][] = array(
							'segid'  => encode_url($value->segment_id),
							'name'  => $value->segment_name,
						);
					}

					//print_obj($this->data['seg_data']);die;

				} else {
					$this->data['seg_data'] = '';
				}


				$this->load->view('checklists/vw_checklist_edit', $this->data, false);
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function onChangeChecklist()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'Checklist';
			$checklist_id = decode_url(xss_clean($this->input->post('checklistid')));
			$chkdata = array('checklist_id'  => $checklist_id);

			$name = xss_clean($this->input->post('name'));
			$company_id = decode_url(xss_clean($this->input->post('comp_id')));
			$segment_id = decode_url(xss_clean($this->input->post('seg_id')));
			$cycle_id = decode_url(xss_clean($this->input->post('cycleid')));
			$quantity = xss_clean($this->input->post('quantity'));
			$carton = xss_clean($this->input->post('carton'));
			$tyre = xss_clean($this->input->post('tyre'));
			$rim = xss_clean($this->input->post('rim'));
			$busket = xss_clean($this->input->post('busket'));
			$frame = xss_clean($this->input->post('frame'));
			$mudguard = xss_clean($this->input->post('mudguard'));
			$sit = xss_clean($this->input->post('sit'));
			$handle = xss_clean($this->input->post('handle'));
			$carrier = xss_clean($this->input->post('carrier'));

			// print_obj($upd_userdata);die;

			$getdata = $this->am->getChecklistData($chkdata, FALSE);
			if (!empty($getdata)) {
				//update

				$upd_data = array(
					'checklist_name'  => $name,
					'company_id'  => $company_id,
					'segment_id'  => $segment_id,
					'cycle_id'  => $cycle_id,
					'quantity'  => $quantity,
					'carton'  => $carton,
					'tyre'  => $tyre,
					'rim'  => $rim,
					'busket'  => $busket,
					'frame'  => $frame,
					'mudguard'  => $mudguard,
					'sit'  => $sit,
					'handle'  => $handle,
					'carrier'  => $carrier,
					'edited_dtime'  => dtime,
					'edited_by'  => $this->session->userdata('userid')
				);

				$upduser = $this->am->updateChecklist($upd_data, $chkdata);
				if ($upduser) {
					$this->data['update_success'] = 'Successfully updated.';
					//list

					$dataUpd = $this->am->getChecklists($chkdata, FALSE);
					$this->data['edit_data'] = array(
						'dtime'  => $dataUpd->added_dtime,
						'cycleid'  => encode_url($dataUpd->cycle_id),
						'cycle_name'  => $dataUpd->cycle_name,
						'compid'  => encode_url($dataUpd->company_id),
						'segid'  => encode_url($dataUpd->segment_id),
						'checklistid'  => encode_url($dataUpd->checklist_id),
						'name'  => $dataUpd->checklist_name,
						'quantity'  => $dataUpd->quantity,
						'carton'  => $dataUpd->carton,
						'tyre'  => $dataUpd->tyre,
						'busket'  => $dataUpd->busket,
						'rim'  => $dataUpd->rim,
						'rim'  => $dataUpd->rim,
						'frame'  => $dataUpd->frame,
						'mudguard'  => $dataUpd->mudguard,
						'sit'  => $dataUpd->sit,
						'handle'  => $dataUpd->handle,
						'carrier'  => $dataUpd->carrier,
					);

					$compdata = $this->am->getCompanyData(array('status' => 1), TRUE);
					if (!empty($compdata)) {
						foreach ($compdata as $key => $value) {
							$this->data['comp_data'][] = array(
								'compid'  => encode_url($value->company_id),
								'name'  => $value->company_name,
							);
						}

						//print_obj($this->data['comp_data']);die;

					} else {
						$this->data['comp_data'] = '';
					}

					$segdata = $this->am->getSegmentData(array('status' => 1), TRUE);
					if (!empty($segdata)) {
						foreach ($segdata as $key => $value) {
							$this->data['seg_data'][] = array(
								'segid'  => encode_url($value->segment_id),
								'name'  => $value->segment_name,
							);
						}

						//print_obj($this->data['seg_data']);die;

					} else {
						$this->data['seg_data'] = '';
					}
				} else {
					$this->data['update_failure'] = 'Not updated!';
				}

				$this->load->view('checklists/vw_checklist_edit', $this->data, false);
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function onCreateChecklistView()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'Checklist';

			$compdata = $this->am->getCompanyData(array('status' => 1), TRUE);
			if (!empty($compdata)) {
				foreach ($compdata as $key => $value) {
					$this->data['comp_data'][] = array(
						'compid'  => encode_url($value->company_id),
						'name'  => $value->company_name,
					);
				}

				//print_obj($this->data['comp_data']);die;

			} else {
				$this->data['comp_data'] = '';
			}

			$segdata = $this->am->getSegmentData(array('status' => 1), TRUE);
			if (!empty($segdata)) {
				foreach ($segdata as $key => $value) {
					$this->data['seg_data'][] = array(
						'segid'  => encode_url($value->segment_id),
						'name'  => $value->segment_name,
					);
				}

				//print_obj($this->data['seg_data']);die;

			} else {
				$this->data['seg_data'] = '';
			}


			$this->load->view('checklists/vw_checklist_add', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onCreateChecklist()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$this->form_validation->set_rules('name', 'Checklist Name', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('comp_id', 'Company Name', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('seg_id', 'Segment Name', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('cycleid', 'Segment Name', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('carton', 'Carton', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('tyre', 'Tyre', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('rim', 'Rim', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('busket', 'Busket', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('frame', 'Frame', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('mudguard', 'Mudguard', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('sit', 'Sit', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('handle', 'Handle', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('carrier', 'Carrier', 'trim|required|xss_clean|htmlentities');

				if ($this->form_validation->run() == FALSE) {
					$this->form_validation->set_error_delimiters('', '');
					$return['errors'] = validation_errors();
					$return['added'] = 'rule_error';
				} else {

					$name = xss_clean($this->input->post('name'));
					$company_id = decode_url(xss_clean($this->input->post('comp_id')));
					$segment_id = decode_url(xss_clean($this->input->post('seg_id')));
					$cycle_id = decode_url(xss_clean($this->input->post('cycleid')));
					$quantity = xss_clean($this->input->post('quantity'));
					$carton = xss_clean($this->input->post('carton'));
					$tyre = xss_clean($this->input->post('tyre'));
					$rim = xss_clean($this->input->post('rim'));
					$busket = xss_clean($this->input->post('busket'));
					$frame = xss_clean($this->input->post('frame'));
					$mudguard = xss_clean($this->input->post('mudguard'));
					$sit = xss_clean($this->input->post('sit'));
					$handle = xss_clean($this->input->post('handle'));
					$carrier = xss_clean($this->input->post('carrier'));

					$chkdata = array('checklist_name'  => $name);
					$getdata = $this->am->getChecklistData($chkdata, FALSE);

					if (!$getdata) {

						//add
						$ins_data = array(
							'checklist_name'  => $name,
							'company_id'  => $company_id,
							'segment_id'  => $segment_id,
							'cycle_id'  => $cycle_id,
							'quantity'  => $quantity,
							'carton'  => $carton,
							'tyre'  => $tyre,
							'rim'  => $rim,
							'busket'  => $busket,
							'frame'  => $frame,
							'mudguard'  => $mudguard,
							'sit'  => $sit,
							'handle'  => $handle,
							'carrier'  => $carrier,
							'added_dtime'  => dtime,
							'added_by'  => $this->session->userdata('userid')
						);
						// print_obj($ins_data);die;
						$added = $this->am->addChecklist($ins_data);

						if ($added) {
							$return['added'] = 'success';
						} else {
							$return['added'] = 'failure';
						}
					} else {
						$return['added'] = 'already_exists';
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

	public function onDeleteChecklist()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1 && $this->session->userdata('usergroup') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$checklist_id  = decode_url(xss_clean($this->input->post('delid')));
				$getdata = $this->am->getChecklistData(array('checklist_id'  => $checklist_id), FALSE);

				if (!empty($getdata)) {
					//del
					$del = $this->am->delChecklist(array('checklist_id' => $checklist_id));

					if ($del) {
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

	//billing
	
	public function onChecklistBilling()
	{
		// if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

		$this->data['page_title'] = 'Checklist Billing';

		$compdata = $this->am->getCompanyData(array('status' => 1), TRUE);
		if (!empty($compdata)) {
			foreach ($compdata as $key => $value) {
				$this->data['comp_data'][] = array(
					'compid'  => encode_url($value->company_id),
					'name'  => $value->company_name,
				);
			}

			//print_obj($this->data['comp_data']);die;

		} else {
			$this->data['comp_data'] = '';
		}

		$segdata = $this->am->getSegmentData(array('status' => 1), TRUE);
		if (!empty($segdata)) {
			foreach ($segdata as $key => $value) {
				$this->data['seg_data'][] = array(
					'segid'  => encode_url($value->segment_id),
					'name'  => $value->segment_name,
				);
			}

			//print_obj($this->data['seg_data']);die;

		} else {
			$this->data['seg_data'] = '';
		}


		$this->load->view('checklists/vw_checklist_billing_list', $this->data, false);
		// } else {
		// 	redirect(base_url());
		// }
	}

	public function getMultipleOfQty()
	{
		// if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
		if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

			$comp_id = decode_url(xss_clean($this->input->post('comp_id')));
			$seg_id = decode_url(xss_clean($this->input->post('seg_id')));
			$cycleid = decode_url(xss_clean($this->input->post('cycleid')));
			$quantity = xss_clean($this->input->post('quantity'));
			$color = decode_url(xss_clean($this->input->post('color')));

			$getData = $this->am->getChecklistData(array('company_id' => $comp_id, 'segment_id' => $seg_id, 'cycle_id' => $cycleid, 'checklist_name' => $color));
			// print_obj($getData);die;
			if (!empty($getData)) {
				$div = ($quantity / $getData->quantity);

				if (!is_float($div)) {
					if ($quantity == $getData->quantity) {
						$resp = array(
							'quantity' => $getData->quantity,
							'carton' => $getData->carton,
							'tyre' => $getData->tyre,
							'rim' => $getData->rim,
							'busket' => $getData->busket,
							'frame' => $getData->frame,
							'mudguard' => $getData->mudguard,
							'sit' => $getData->sit,
							'handle' => $getData->handle,
							'carrier' => $getData->carrier,
							'color' => $getData->checklist_name
						);

						$msg = 'Found!';
					} else {
						$resp = array(
							'quantity' => $getData->quantity,
							'carton' => ($getData->carton * $div),
							'tyre' => ($getData->tyre * $div),
							'rim' => ($getData->rim * $div),
							'busket' => ($getData->busket * $div),
							'frame' => ($getData->frame * $div),
							'mudguard' => ($getData->mudguard * $div),
							'sit' => ($getData->sit * $div),
							'handle' => ($getData->handle * $div),
							'carrier' => ($getData->carrier * $div),
							'color' => $getData->checklist_name
						);

						$msg = 'Found!';
					}
				} else {
					$resp = '';
					$msg = 'Entered quantity is wrong!';
				}

				$return['list'] = $resp;
				$return['msg'] = $msg;
			} else {
				$return['list'] = '';
				$return['msg'] = 'No data found!';
			}

			header('Content-Type: application/json');

			echo json_encode($return);
		} else {
			//exit('No direct script access allowed');
			redirect(base_url());
		}
		// } else {
		// 	redirect(base_url());
		// }
	}


	public function onSaveChecklist()
	{
		// if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
		// if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

		// print_obj($this->input->post());die;
		$sl_count = xss_clean($this->input->post('sl_count'));
		if ($sl_count > 0) {
			$unique_id = random_strings(8) . date('His');

			for ($sl = 1; $sl <= $sl_count; $sl++) {
				$comp_id = decode_url(xss_clean($this->input->post('comp_id_' . $sl)));
				$seg_id = decode_url(xss_clean($this->input->post('seg_id_' . $sl)));
				$cycleid = decode_url(xss_clean($this->input->post('cycleid_' . $sl)));
				$quantity = xss_clean($this->input->post('quantity_' . $sl));
				$color = decode_url(xss_clean($this->input->post('color_' . $sl)));
				$carton = xss_clean($this->input->post('carton_' . $sl));
				$tyre = xss_clean($this->input->post('tyre_' . $sl));
				$rim = xss_clean($this->input->post('rim_' . $sl));
				$busket = xss_clean($this->input->post('busket_' . $sl));
				$frame = xss_clean($this->input->post('frame_' . $sl));
				$mudguard = xss_clean($this->input->post('mudguard_' . $sl));
				$sit = xss_clean($this->input->post('sit_' . $sl));
				$handle = xss_clean($this->input->post('handle_' . $sl));
				$carrier = xss_clean($this->input->post('carrier_' . $sl));

				$cust_name = xss_clean($this->input->post('cust_name'));
				$cust_address = xss_clean($this->input->post('cust_address'));
				$cust_phone = xss_clean($this->input->post('cust_phone'));
				$total_quantity = xss_clean($this->input->post('total_quantity'));
				$total_quantity_carton = xss_clean($this->input->post('total_quantity_carton'));
				$total_quantity_tyre = xss_clean($this->input->post('total_quantity_tyre'));
				$total_quantity_rim = xss_clean($this->input->post('total_quantity_rim'));
				$total_quantity_busket = xss_clean($this->input->post('total_quantity_busket'));
				$total_quantity_frame = xss_clean($this->input->post('total_quantity_frame'));
				$total_quantity_mudguard = xss_clean($this->input->post('total_quantity_mudguard'));
				$total_quantity_sit = xss_clean($this->input->post('total_quantity_sit'));
				$total_quantity_handle = xss_clean($this->input->post('total_quantity_handle'));
				$total_quantity_carrier = xss_clean($this->input->post('total_quantity_carrier'));

				$ins_data = array(
					'unique_id' => $unique_id,
					'company_id' => $comp_id,
					'segment_id' => $seg_id,
					'cycle_id' => $cycleid,
					'cust_name' => $cust_name,
					'cust_address' => $cust_address,
					'cust_phone' => $cust_phone,
					'quantity' => $quantity,
					'checklist_b_name' => $color,
					'carton' => $carton,
					'tyre' => $tyre,
					'rim' => $rim,
					'busket' => $busket,
					'frame' => $frame,
					'mudguard' => $mudguard,
					'sit' => $sit,
					'handle' => $handle,
					'carrier' => $carrier,
					'total_quantity' => $total_quantity,
					'total_quantity_carton' => $total_quantity_carton,
					'total_quantity_tyre' => $total_quantity_tyre,
					'total_quantity_rim' => $total_quantity_rim,
					'total_quantity_busket' => $total_quantity_busket,
					'total_quantity_frame' => $total_quantity_frame,
					'total_quantity_mudguard' => $total_quantity_mudguard,
					'total_quantity_sit' => $total_quantity_sit,
					'total_quantity_handle' => $total_quantity_handle,
					'total_quantity_carrier' => $total_quantity_carrier,
					'added_dtime' => dtime
				);

				$added = $this->am->addChecklistBilling($ins_data);
			}

			$this->data['added_id'] = $unique_id;
		} else {
			$this->data['added_id'] = '';
		}

		redirect(base_url('checklist-bill-print/' . encode_url($unique_id)));

		// header('Content-Type: application/json');
		// echo json_encode($return);
		// } else {
		// 	//exit('No direct script access allowed');
		// 	redirect(base_url());
		// }
		// } else {
		// 	redirect(base_url());
		// }
	}


	public function onPrintChecklistBill()
	{
		// if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {


		$unique_id = decode_url(xss_clean($this->uri->segment(2)));

		if ($unique_id != '') {
			$getData = $this->am->getChecklistsBilling(array('checklist_billing.unique_id' => $unique_id), TRUE, 'ASC');
			// print_obj($getData);die;
			if (!empty($getData)) {

				foreach ($getData as $key => $value) {
					$resp[] = array(
						'dtime'  => $value->added_dtime,
						'bill_no'  => $unique_id,
						'cycleid'  => encode_url($value->cycle_id),
						'compid'  => encode_url($value->company_id),
						'segid'  => encode_url($value->segment_id),
						// 'checklistid'  => encode_url($value->checklist_b_id),
						'cyclename'  => $value->cycle_name,
						'compname'  => $value->company_name,
						'segname'  => $value->segment_name,
						'cust_name' => $value->cust_name,
						'cust_address' => $value->cust_address,
						'cust_phone' => $value->cust_phone,
						'quantity'  => $value->quantity,
						'color' => $value->checklist_b_name,
						'carton'  => $value->carton,
						'tyre'  => $value->tyre,
						'busket'  => $value->busket,
						'rim'  => $value->rim,
						'frame'  => $value->frame,
						'mudguard'  => $value->mudguard,
						'sit'  => $value->sit,
						'handle'  => $value->handle,
						'carrier'  => $value->carrier,
						'total_quantity' => $value->total_quantity,
						'total_quantity_carton' => $value->total_quantity_carton,
						'total_quantity_tyre' => $value->total_quantity_tyre,
						'total_quantity_rim' => $value->total_quantity_rim,
						'total_quantity_busket' => $value->total_quantity_busket,
						'total_quantity_frame' => $value->total_quantity_frame,
						'total_quantity_mudguard' => $value->total_quantity_mudguard,
						'total_quantity_sit' => $value->total_quantity_sit,
						'total_quantity_handle' => $value->total_quantity_handle,
						'total_quantity_carrier' => $value->total_quantity_carrier,
						'dtime' => $value->added_dtime
					);
				}

				// print_obj($resp);die;
				$this->data['billing_data'] = $resp;
			} else {
				$this->data['billing_data'] = '';
			}
		} else {
			$this->data['billing_data'] = '';
		}



		$this->load->view('checklists/vw_checklist_billing_print', $this->data, false);

		// } else {
		// 	redirect(base_url());
		// }
	}


	public function onGetChecklistBills()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			$this->data['page_title'] = 'Checklist Bills';

			$getdata = $this->am->getChecklistsBillingOrder(null, TRUE);
			// print_obj($getdata);die;
			if (!empty($getdata)) {
				foreach ($getdata as $key => $value) {
					$this->data['list_data'][] = array(
						'dtime'  => $value->added_dtime,
						'bill_no'  => $value->unique_id,
						'cycleid'  => encode_url($value->cycle_id),
						'compid'  => encode_url($value->company_id),
						'segid'  => encode_url($value->segment_id),
						'checklistid'  => encode_url($value->checklist_b_id),
						'cyclename'  => $value->cycle_name,
						'compname'  => $value->company_name,
						'segname'  => $value->segment_name,
						'cust_name' => $value->cust_name,
						'cust_address' => $value->cust_address,
						'cust_phone' => $value->cust_phone,
						// 'quantity'  => $value->quantity,
						// 'color' => $value->checklist_b_name,
						// 'carton'  => $value->carton,
						// 'tyre'  => $value->tyre,
						// 'busket'  => $value->busket,
						// 'rim'  => $value->rim,
						// 'frame'  => $value->frame,
						// 'mudguard'  => $value->mudguard,
						// 'sit'  => $value->sit,
						// 'handle'  => $value->handle,
						// 'carrier'  => $value->carrier,
						// 'total_quantity' => $value->total_quantity,
						// 'total_quantity_carton' => $value->total_quantity_carton,
						// 'total_quantity_tyre' => $value->total_quantity_tyre,
						// 'total_quantity_rim' => $value->total_quantity_rim,
						// 'total_quantity_busket' => $value->total_quantity_busket,
						// 'total_quantity_frame' => $value->total_quantity_frame,
						// 'total_quantity_mudguard' => $value->total_quantity_mudguard,
						// 'total_quantity_sit' => $value->total_quantity_sit,
						// 'total_quantity_handle' => $value->total_quantity_handle,
						// 'total_quantity_carrier' => $value->total_quantity_carrier,
						'dtime' => $value->added_dtime
					);
				}

				//print_obj($this->data['list_data']);die;

			} else {
				$this->data['list_data'] = '';
			}
			$this->load->view('checklists/vw_checklist_bills_list', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onDeleteChecklistBill()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1 && $this->session->userdata('usergroup') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$unique_id  = decode_url(xss_clean($this->input->post('delid')));
				$getdata = $this->am->getChecklistBillingData(array('unique_id'  => $unique_id));

				if (!empty($getdata)) {
					//del
					$del = $this->am->delChecklistBilling(array('unique_id' => $unique_id));

					if ($del) {
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
}
