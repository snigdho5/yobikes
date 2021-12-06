<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checklist2 extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			$this->data['page_title'] = 'Checklists';
			$getdata = $this->am->getChecklists2(array('tbl_checklists_2.status' => 1), TRUE);
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
			$this->load->view('checklists2/vw_checklist_list', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onCheckDuplicateChecklist()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$name = xss_clean($this->input->post('name'));

				$if_exists = $this->am->getChecklist2Data(array('checklist_name' => $name), FALSE);
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
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
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
		} else {
			redirect(base_url());
		}
	}

	public function onGetChecklistEdit()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'Edit Checklist';
			$checklist_id = decode_url(xss_clean($this->uri->segment(2)));
			$chkdata = array(
				'checklist_id'  => $checklist_id
			);
			$getdata = $this->am->getChecklists2($chkdata, FALSE);
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
					'frame_etc'  => $getdata->frame_etc,
					'mudguard_etc'  => $getdata->mudguard_etc,
					'rim_etc'  => $getdata->rim_etc,
					'sit_etc'  => $getdata->sit_etc,
					'chaincover_etc'  => $getdata->chaincover_etc,
					'ball_racer_etc'  => $getdata->ball_racer_etc,
					'ch_wheel_etc'  => $getdata->ch_wheel_etc,
					'pedal_etc'  => $getdata->pedal_etc,
					'chain_etc'  => $getdata->chain_etc,
					'bb_axle_etc'  => $getdata->bb_axle_etc,
					'colter_join_etc'  => $getdata->colter_join_etc,
					'break_set_etc'  => $getdata->break_set_etc,
					'busket_etc'  => $getdata->busket_etc,
					'stand_etc'  => $getdata->stand_etc,
					'mud_screw_etc'  => $getdata->mud_screw_etc,
					'dress_guard_etc'  => $getdata->dress_guard_etc,
					'spock_etc'  => $getdata->spock_etc,
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


				$this->load->view('checklists2/vw_checklist_edit', $this->data, false);
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
			$frame_etc = xss_clean($this->input->post('frame_etc'));
			$mudguard_etc = xss_clean($this->input->post('mudguard_etc'));
			$rim_etc = xss_clean($this->input->post('rim_etc'));
			$sit_etc = xss_clean($this->input->post('sit_etc'));
			$chaincover_etc = xss_clean($this->input->post('chaincover_etc'));
			$ball_racer_etc = xss_clean($this->input->post('ball_racer_etc'));
			$ch_wheel_etc = xss_clean($this->input->post('ch_wheel_etc'));
			$pedal_etc = xss_clean($this->input->post('pedal_etc'));
			$chain_etc = xss_clean($this->input->post('chain_etc'));
			$bb_axle_etc = xss_clean($this->input->post('bb_axle_etc'));
			$colter_join_etc = xss_clean($this->input->post('colter_join_etc'));
			$break_set_etc = xss_clean($this->input->post('break_set_etc'));
			$busket_etc = xss_clean($this->input->post('busket_etc'));
			$stand_etc = xss_clean($this->input->post('stand_etc'));
			$mud_screw_etc = xss_clean($this->input->post('mud_screw_etc'));
			$dress_guard_etc = xss_clean($this->input->post('dress_guard_etc'));
			$spock_etc = xss_clean($this->input->post('spock_etc'));

			// print_obj($upd_userdata);die;

			$getdata = $this->am->getChecklist2Data($chkdata, FALSE);
			if (!empty($getdata)) {
				//update

				$upd_data = array(
					'checklist_name'  => $name,
					'company_id'  => $company_id,
					'segment_id'  => $segment_id,
					'cycle_id'  => $cycle_id,
					'quantity'  => $quantity,
					'frame_etc'  => $frame_etc,
					'mudguard_etc'  => $mudguard_etc,
					'rim_etc'  => $rim_etc,
					'sit_etc'  => $sit_etc,
					'chaincover_etc'  => $chaincover_etc,
					'ball_racer_etc'  => $ball_racer_etc,
					'ch_wheel_etc'  => $ch_wheel_etc,
					'pedal_etc'  => $pedal_etc,
					'chain_etc'  => $chain_etc,
					'bb_axle_etc'  => $bb_axle_etc,
					'colter_join_etc'  => $colter_join_etc,
					'break_set_etc'  => $break_set_etc,
					'busket_etc'  => $busket_etc,
					'stand_etc'  => $stand_etc,
					'mud_screw_etc'  => $mud_screw_etc,
					'dress_guard_etc'  => $dress_guard_etc,
					'spock_etc'  => $spock_etc,
					'edited_dtime'  => dtime,
					'edited_by'  => $this->session->userdata('userid')
				);

				$upduser = $this->am->updateChecklist2($upd_data, $chkdata);
				if ($upduser) {
					$this->data['update_success'] = 'Successfully updated.';
					//list

					$dataUpd = $this->am->getChecklists2($chkdata, FALSE);
					$this->data['edit_data'] = array(
						'dtime'  => $dataUpd->added_dtime,
						'cycleid'  => encode_url($dataUpd->cycle_id),
						'cycle_name'  => $dataUpd->cycle_name,
						'compid'  => encode_url($dataUpd->company_id),
						'segid'  => encode_url($dataUpd->segment_id),
						'checklistid'  => encode_url($dataUpd->checklist_id),
						'name'  => $dataUpd->checklist_name,
						'quantity'  => $dataUpd->quantity,
						'frame_etc'  => $dataUpd->frame_etc,
						'mudguard_etc'  => $dataUpd->mudguard_etc,
						'rim_etc'  => $dataUpd->rim_etc,
						'sit_etc'  => $dataUpd->sit_etc,
						'chaincover_etc'  => $dataUpd->chaincover_etc,
						'ball_racer_etc'  => $dataUpd->ball_racer_etc,
						'ch_wheel_etc'  => $dataUpd->ch_wheel_etc,
						'pedal_etc'  => $dataUpd->pedal_etc,
						'chain_etc'  => $dataUpd->chain_etc,
						'bb_axle_etc'  => $dataUpd->bb_axle_etc,
						'colter_join_etc'  => $dataUpd->colter_join_etc,
						'break_set_etc'  => $dataUpd->break_set_etc,
						'busket_etc'  => $dataUpd->busket_etc,
						'stand_etc'  => $dataUpd->stand_etc,
						'mud_screw_etc'  => $dataUpd->mud_screw_etc,
						'dress_guard_etc'  => $dataUpd->dress_guard_etc,
						'spock_etc'  => $dataUpd->spock_etc
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

				$this->load->view('checklists2/vw_checklist_edit', $this->data, false);
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


			$this->load->view('checklists2/vw_checklist_add', $this->data, false);
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
				$this->form_validation->set_rules('frame_etc', 'frame_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('mudguard_etc', 'mudguard_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('rim_etc', 'rim_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('sit_etc', 'sit_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('chaincover_etc', 'chaincover_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('ball_racer_etc', 'ball_racer_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('ch_wheel_etc', 'ch_wheel_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('pedal_etc', 'pedal_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('chain_etc', 'chain_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('bb_axle_etc', 'bb_axle_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('colter_join_etc', 'colter_join_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('break_set_etc', 'break_set_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('busket_etc', 'busket_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('stand_etc', 'stand_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('mud_screw_etc', 'mud_screw_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('dress_guard_etc', 'dress_guard_etc', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('spock_etc', 'spock_etc', 'trim|required|xss_clean|htmlentities');

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
					$frame_etc = xss_clean($this->input->post('frame_etc'));
					$mudguard_etc = xss_clean($this->input->post('mudguard_etc'));
					$rim_etc = xss_clean($this->input->post('rim_etc'));
					$sit_etc = xss_clean($this->input->post('sit_etc'));
					$chaincover_etc = xss_clean($this->input->post('chaincover_etc'));
					$ball_racer_etc = xss_clean($this->input->post('ball_racer_etc'));
					$ch_wheel_etc = xss_clean($this->input->post('ch_wheel_etc'));
					$pedal_etc = xss_clean($this->input->post('pedal_etc'));
					$chain_etc = xss_clean($this->input->post('chain_etc'));
					$bb_axle_etc = xss_clean($this->input->post('bb_axle_etc'));
					$colter_join_etc = xss_clean($this->input->post('colter_join_etc'));
					$break_set_etc = xss_clean($this->input->post('break_set_etc'));
					$busket_etc = xss_clean($this->input->post('busket_etc'));
					$stand_etc = xss_clean($this->input->post('stand_etc'));
					$mud_screw_etc = xss_clean($this->input->post('mud_screw_etc'));
					$dress_guard_etc = xss_clean($this->input->post('dress_guard_etc'));
					$spock_etc = xss_clean($this->input->post('spock_etc'));

					$chkdata = array('checklist_name'  => $name);
					$getdata = $this->am->getChecklist2Data($chkdata, FALSE);

					if (!$getdata) {

						//add
						$ins_data = array(
							'checklist_name'  => $name,
							'company_id'  => $company_id,
							'segment_id'  => $segment_id,
							'cycle_id'  => $cycle_id,
							'quantity'  => $quantity,
							'frame_etc'  => $frame_etc,
							'mudguard_etc'  => $mudguard_etc,
							'rim_etc'  => $rim_etc,
							'sit_etc'  => $sit_etc,
							'chaincover_etc'  => $chaincover_etc,
							'ball_racer_etc'  => $ball_racer_etc,
							'ch_wheel_etc'  => $ch_wheel_etc,
							'pedal_etc'  => $pedal_etc,
							'chain_etc'  => $chain_etc,
							'bb_axle_etc'  => $bb_axle_etc,
							'colter_join_etc'  => $colter_join_etc,
							'break_set_etc'  => $break_set_etc,
							'busket_etc'  => $busket_etc,
							'stand_etc'  => $stand_etc,
							'mud_screw_etc'  => $mud_screw_etc,
							'dress_guard_etc'  => $dress_guard_etc,
							'spock_etc'  => $spock_etc,
							'added_dtime'  => dtime,
							'added_by'  => $this->session->userdata('userid')
						);
						// print_obj($ins_data);die;
						$added = $this->am->addChecklist2($ins_data);

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
				$getdata = $this->am->getChecklist2Data(array('checklist_id'  => $checklist_id), FALSE);

				if (!empty($getdata)) {
					//del
					$del = $this->am->delChecklist2(array('checklist_id' => $checklist_id));

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

	public function getColor()
	{
		// if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$comp_id = decode_url(xss_clean($this->input->post('comp_id')));
				$seg_id = decode_url(xss_clean($this->input->post('seg_id')));
				$cycleid = decode_url(xss_clean($this->input->post('cycleid')));
				$dropdown = '<option value="">Select</option>';

				$colors = $this->am->getChecklist2Data(array('company_id' => $comp_id, 'segment_id' => $seg_id, 'cycle_id' => $cycleid), TRUE);
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

	public function onChecklistBilling()
	{
		// if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

		$this->data['page_title'] = 'Checklist2 Billing';

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


		$this->load->view('checklists2/vw_checklist_billing_list', $this->data, false);
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

			$getData = $this->am->getChecklist2Data(array('company_id' => $comp_id, 'segment_id' => $seg_id, 'cycle_id' => $cycleid, 'checklist_name' => $color));
			// print_obj($getData);die;
			if (!empty($getData)) {
				$div = ($quantity / $getData->quantity);

				if (!is_float($div)) {
					if ($quantity == $getData->quantity) {
						$resp = array(
							'quantity' => $getData->quantity,
							'frame_etc'  => $getData->frame_etc,
							'mudguard_etc'  => $getData->mudguard_etc,
							'rim_etc'  => $getData->rim_etc,
							'sit_etc'  => $getData->sit_etc,
							'chaincover_etc'  => $getData->chaincover_etc,
							'ball_racer_etc'  => $getData->ball_racer_etc,
							'ch_wheel_etc'  => $getData->ch_wheel_etc,
							'pedal_etc'  => $getData->pedal_etc,
							'chain_etc'  => $getData->chain_etc,
							'bb_axle_etc'  => $getData->bb_axle_etc,
							'colter_join_etc'  => $getData->colter_join_etc,
							'break_set_etc'  => $getData->break_set_etc,
							'busket_etc'  => $getData->busket_etc,
							'stand_etc'  => $getData->stand_etc,
							'mud_screw_etc'  => $getData->mud_screw_etc,
							'dress_guard_etc'  => $getData->dress_guard_etc,
							'spock_etc'  => $getData->spock_etc,
							'color' => $getData->checklist_name
						);

						$msg = 'Found!';
					} else {
						$resp = array(
							'quantity' => $getData->quantity,
							'frame_etc'  => ($getData->frame_etc * $div),
							'mudguard_etc'  => ($getData->mudguard_etc * $div),
							'rim_etc'  => ($getData->rim_etc * $div),
							'sit_etc'  => ($getData->sit_etc * $div),
							'chaincover_etc'  => ($getData->chaincover_etc * $div),
							'ball_racer_etc'  => ($getData->ball_racer_etc * $div),
							'ch_wheel_etc'  => ($getData->ch_wheel_etc * $div),
							'pedal_etc'  => ($getData->pedal_etc * $div),
							'chain_etc'  => ($getData->chain_etc * $div),
							'bb_axle_etc'  => ($getData->bb_axle_etc * $div),
							'colter_join_etc'  => ($getData->colter_join_etc * $div),
							'break_set_etc'  => ($getData->break_set_etc * $div),
							'busket_etc'  => ($getData->busket_etc * $div),
							'stand_etc'  => ($getData->stand_etc * $div),
							'mud_screw_etc'  => ($getData->mud_screw_etc * $div),
							'dress_guard_etc'  => ($getData->dress_guard_etc * $div),
							'spock_etc'  => ($getData->spock_etc * $div),
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
				$frame_etc = xss_clean($this->input->post('frame_etc_' . $sl));
				$mudguard_etc = xss_clean($this->input->post('mudguard_etc_' . $sl));
				$rim_etc = xss_clean($this->input->post('rim_etc' . $sl));
				$sit_etc = xss_clean($this->input->post('sit_etc_' . $sl));
				$chaincover_etc = xss_clean($this->input->post('chaincover_etc_' . $sl));
				$ball_racer_etc = xss_clean($this->input->post('ball_racer_etc_' . $sl));
				$ch_wheel_etc = xss_clean($this->input->post('ch_wheel_etc_' . $sl));
				$pedal_etc = xss_clean($this->input->post('pedal_etc_' . $sl));
				$chain_etc = xss_clean($this->input->post('chain_etc_' . $sl));
				$bb_axle_etc = xss_clean($this->input->post('bb_axle_etc_' . $sl));
				$colter_join_etc = xss_clean($this->input->post('colter_join_etc_' . $sl));
				$break_set_etc = xss_clean($this->input->post('break_set_etc_' . $sl));
				$busket_etc = xss_clean($this->input->post('busket_etc_' . $sl));
				$stand_etc = xss_clean($this->input->post('stand_etc_' . $sl));
				$mud_screw_etc = xss_clean($this->input->post('mud_screw_etc_' . $sl));
				$dress_guard_etc = xss_clean($this->input->post('dress_guard_etc_' . $sl));
				$spock_etc = xss_clean($this->input->post('spock_etc_' . $sl));

				$cust_name = xss_clean($this->input->post('cust_name'));
				$cust_address = xss_clean($this->input->post('cust_address'));
				$cust_phone = xss_clean($this->input->post('cust_phone'));
				$total_quantity = xss_clean($this->input->post('total_quantity'));
				$total_quantity_frame_etc = xss_clean($this->input->post('total_quantity_frame_etc'));
				$total_quantity_mudguard_etc = xss_clean($this->input->post('total_quantity_mudguard_etc'));
				$total_quantity_rim_etc = xss_clean($this->input->post('total_quantity_rim_etc'));
				$total_quantity_sit_etc = xss_clean($this->input->post('total_quantity_sit_etc'));
				$total_quantity_chaincover_etc = xss_clean($this->input->post('total_quantity_chaincover_etc'));
				$total_quantity_ball_racer_etc = xss_clean($this->input->post('total_quantity_ball_racer_etc'));
				$total_quantity_ch_wheel_etc = xss_clean($this->input->post('total_quantity_ch_wheel_etc'));
				$total_quantity_pedal_etc = xss_clean($this->input->post('total_quantity_pedal_etc'));
				$total_quantity_chain_etc = xss_clean($this->input->post('total_quantity_chain_etc'));
				$total_quantity_bb_axle_etc = xss_clean($this->input->post('total_quantity_bb_axle_etc'));
				$total_quantity_colter_join_etc = xss_clean($this->input->post('total_quantity_colter_join_etc'));
				$total_quantity_break_set_etc = xss_clean($this->input->post('total_quantity_break_set_etc'));
				$total_quantity_busket_etc = xss_clean($this->input->post('total_quantity_busket_etc'));
				$total_quantity_stand_etc = xss_clean($this->input->post('total_quantity_stand_etc'));
				$total_quantity_mud_screw_etc = xss_clean($this->input->post('total_quantity_mud_screw_etc'));
				$total_quantity_dress_guard_etc = xss_clean($this->input->post('total_quantity_dress_guard_etc'));
				$total_quantity_spock_etc = xss_clean($this->input->post('total_quantity_spock_etc'));

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
					'frame_etc' => $frame_etc,
					'mudguard_etc' => $mudguard_etc,
					'rim_etc' => $rim_etc,
					'sit_etc' => $sit_etc,
					'chaincover_etc' => $chaincover_etc,
					'ball_racer_etc' => $ball_racer_etc,
					'ch_wheel_etc' => $ch_wheel_etc,
					'pedal_etc' => $pedal_etc,
					'chain_etc' => $chain_etc,
					'bb_axle_etc' => $bb_axle_etc,
					'colter_join_etc' => $colter_join_etc,
					'break_set_etc' => $break_set_etc,
					'busket_etc' => $busket_etc,
					'stand_etc' => $stand_etc,
					'mud_screw_etc' => $mud_screw_etc,
					'dress_guard_etc' => $dress_guard_etc,
					'spock_etc' => $spock_etc,
					'total_quantity' => $total_quantity,
					'total_quantity_frame_etc' => $total_quantity_frame_etc,
					'total_quantity_mudguard_etc' => $total_quantity_mudguard_etc,
					'total_quantity_rim_etc' => $total_quantity_rim_etc,
					'total_quantity_sit_etc' => $total_quantity_sit_etc,
					'total_quantity_chaincover_etc' => $total_quantity_chaincover_etc,
					'total_quantity_ball_racer_etc' => $total_quantity_ball_racer_etc,
					'total_quantity_ch_wheel_etc' => $total_quantity_ch_wheel_etc,
					'total_quantity_pedal_etc' => $total_quantity_pedal_etc,
					'total_quantity_chain_etc' => $total_quantity_chain_etc,
					'total_quantity_bb_axle_etc' => $total_quantity_bb_axle_etc,
					'total_quantity_colter_join_etc' => $total_quantity_colter_join_etc,
					'total_quantity_break_set_etc' => $total_quantity_break_set_etc,
					'total_quantity_busket_etc' => $total_quantity_busket_etc,
					'total_quantity_stand_etc' => $total_quantity_stand_etc,
					'total_quantity_mud_screw_etc' => $total_quantity_mud_screw_etc,
					'total_quantity_dress_guard_etc' => $total_quantity_dress_guard_etc,
					'total_quantity_spock_etc' => $total_quantity_spock_etc,
					'added_dtime' => dtime
				);

				$added = $this->am->addChecklist2Billing($ins_data);
			}

			$this->data['added_id'] = $unique_id;
		} else {
			$this->data['added_id'] = '';
		}

		redirect(base_url('checklist2-bill-print/' . encode_url($unique_id)));

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
			$getData = $this->am->getChecklists2Billing(array('checklist2_billing.unique_id' => $unique_id), TRUE, 'ASC');
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
						'frame_etc'  => $value->frame_etc,
						'mudguard_etc'  => $value->mudguard_etc,
						'rim_etc'  => $value->rim_etc,
						'sit_etc'  => $value->sit_etc,
						'chaincover_etc'  => $value->chaincover_etc,
						'ball_racer_etc'  => $value->ball_racer_etc,
						'ch_wheel_etc'  => $value->ch_wheel_etc,
						'pedal_etc'  => $value->pedal_etc,
						'chain_etc'  => $value->chain_etc,
						'bb_axle_etc'  => $value->bb_axle_etc,
						'colter_join_etc'  => $value->colter_join_etc,
						'break_set_etc'  => $value->break_set_etc,
						'busket_etc'  => $value->busket_etc,
						'stand_etc'  => $value->stand_etc,
						'mud_screw_etc'  => $value->mud_screw_etc,
						'dress_guard_etc'  => $value->dress_guard_etc,
						'spock_etc'  => $value->spock_etc,
						'total_quantity' => $value->total_quantity,
						'total_quantity_frame_etc' => $value->total_quantity_frame_etc,
						'total_quantity_mudguard_etc' => $value->total_quantity_mudguard_etc,
						'total_quantity_rim_etc' => $value->total_quantity_rim_etc,
						'total_quantity_sit_etc' => $value->total_quantity_sit_etc,
						'total_quantity_chaincover_etc' => $value->total_quantity_chaincover_etc,
						'total_quantity_ball_racer_etc' => $value->total_quantity_ball_racer_etc,
						'total_quantity_ch_wheel_etc' => $value->total_quantity_ch_wheel_etc,
						'total_quantity_pedal_etc' => $value->total_quantity_pedal_etc,
						'total_quantity_chain_etc' => $value->total_quantity_chain_etc,
						'total_quantity_bb_axle_etc' => $value->total_quantity_bb_axle_etc,
						'total_quantity_colter_join_etc' => $value->total_quantity_colter_join_etc,
						'total_quantity_break_set_etc' => $value->total_quantity_break_set_etc,
						'total_quantity_busket_etc' => $value->total_quantity_busket_etc,
						'total_quantity_stand_etc' => $value->total_quantity_stand_etc,
						'total_quantity_mud_screw_etc' => $value->total_quantity_mud_screw_etc,
						'total_quantity_dress_guard_etc' => $value->total_quantity_dress_guard_etc,
						'total_quantity_spock_etc' => $value->total_quantity_spock_etc,
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



		$this->load->view('checklists2/vw_checklist_billing_print', $this->data, false);

		// } else {
		// 	redirect(base_url());
		// }
	}


	public function onGetChecklistBills()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			$this->data['page_title'] = 'Checklist2 Bills';

			$getdata = $this->am->getChecklists2BillingOrder(null, TRUE);
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
			$this->load->view('checklists2/vw_checklist_bills_list', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onDeleteChecklistBill()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1 && $this->session->userdata('usergroup') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$unique_id  = decode_url(xss_clean($this->input->post('delid')));
				$getdata = $this->am->getChecklist2BillingData(array('unique_id'  => $unique_id));

				if (!empty($getdata)) {
					//del
					$del = $this->am->delChecklist2Billing(array('unique_id' => $unique_id));

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
