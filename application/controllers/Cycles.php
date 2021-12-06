<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cycles extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			$this->data['page_title'] = 'Cycles';
			$getdata = $this->am->getCycles(array('mt_cycle.status' => 1), TRUE);
			if (!empty($getdata)) {
				foreach ($getdata as $key => $value) {
					$this->data['list_data'][] = array(
						'dtime'  => $value->added_dtime,
						'cycleid'  => encode_url($value->cycle_id),
						'name'  => $value->cycle_name,
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
			$this->load->view('cycles/vw_cycle_list', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onCheckDuplicateCycle()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$name = xss_clean($this->input->post('name'));

				$if_exists = $this->am->getCycleData(array('cycle_name' => $name), FALSE);
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

	public function onGetCycleEdit()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'Edit Cycle';
			$cycle_id = decode_url(xss_clean($this->uri->segment(2)));
			$chkdata = array(
				'cycle_id'  => $cycle_id
			);
			$getdata = $this->am->getCycleData($chkdata, FALSE);
			if (!empty($getdata)) {
				$this->data['edit_data'] = array(
					'dtime'  => $getdata->added_dtime,
					'cycleid'  => encode_url($getdata->cycle_id),
					'compid'  => encode_url($getdata->company_id),
					'segid'  => encode_url($getdata->segment_id),
					'name'  => $getdata->cycle_name,
					'status'  => $getdata->status,
					'added_by'  => $getdata->added_by,
					'edited_dtime'  => ($getdata->edited_dtime != '') ? $getdata->edited_dtime : 'NA'
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

				$this->load->view('cycles/vw_cycle_edit', $this->data, false);
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function onChangeCycle()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'Cycle';
			$cycle_id = decode_url(xss_clean($this->input->post('cyc_id')));
			$chkdata = array('cycle_id'  => $cycle_id);

			$name = xss_clean($this->input->post('name'));
			$company_id = decode_url(xss_clean($this->input->post('comp_id')));
			$segment_id = decode_url(xss_clean($this->input->post('seg_id')));

			// print_obj($upd_userdata);die;

			$getdata = $this->am->getCycleData($chkdata, FALSE);
			if (!empty($getdata)) {
				//update

				$upd_data = array(
					'cycle_name'  => $name,
					'company_id'  => $company_id,
					'segment_id'  => $segment_id,
					'edited_dtime'  => dtime,
					'edited_by'  => $this->session->userdata('userid')
				);

				$upduser = $this->am->updateCycle($upd_data, $chkdata);
				if ($upduser) {
					$this->data['update_success'] = 'Successfully updated.';
					//list

					$dataUpd = $this->am->getCycleData($chkdata, FALSE);
					$this->data['edit_data'] = array(
						'dtime'  => $dataUpd->added_dtime,
						'cycleid'  => encode_url($getdata->cycle_id),
						'compid'  => encode_url($getdata->company_id),
						'segid'  => encode_url($getdata->segment_id),
						'name'  => $dataUpd->cycle_name,
						'status'  => $dataUpd->status,
						'added_by'  => $dataUpd->added_by,
						'edited_dtime'  => ($dataUpd->edited_dtime != '') ? $dataUpd->edited_dtime : 'NA'
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

				$this->load->view('cycles/vw_cycle_edit', $this->data, false);
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function onCreateCycleView()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'Cycle';

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


			$this->load->view('cycles/vw_cycle_add', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onCreateCycle()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$this->form_validation->set_rules('name', 'Cycle Name', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('comp_id', 'Company Name', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('seg_id', 'Segment Name', 'trim|required|xss_clean|htmlentities');

				if ($this->form_validation->run() == FALSE) {
					$this->form_validation->set_error_delimiters('', '');
					$return['errors'] = validation_errors();
					$return['added'] = 'rule_error';
				} else {

					$name = xss_clean($this->input->post('name'));
					$company_id = decode_url(xss_clean($this->input->post('comp_id')));
					$segment_id = decode_url(xss_clean($this->input->post('seg_id')));
					$chkdata = array('cycle_name'  => $name);
					$getdata = $this->am->getCycleData($chkdata, FALSE);

					if (!$getdata) {

						//add
						$ins_data = array(
							'cycle_name'  => $name,
							'company_id'  => $company_id,
							'segment_id'  => $segment_id,
							'added_dtime'  => dtime,
							'added_by'  => $this->session->userdata('userid')
						);
						// print_obj($ins_data);die;
						$addcust = $this->am->addCycle($ins_data);

						if ($addcust) {
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

	public function onDeleteCycle()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1 && $this->session->userdata('usergroup') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$cycle_id  = decode_url(xss_clean($this->input->post('delid')));
				$getdata = $this->am->getCycleData(array('cycle_id'  => $cycle_id), FALSE);

				if (!empty($getdata)) {
					//del
					$del = $this->am->delCycle(array('cycle_id' => $cycle_id));

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
