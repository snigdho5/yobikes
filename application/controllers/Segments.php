<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Segments extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			$this->data['page_title'] = 'Segments';
			$getdata = $this->am->getSegmentData(array('status' => 1), TRUE);
			if (!empty($getdata)) {
				foreach ($getdata as $key => $value) {
					$this->data['list_data'][] = array(
						'dtime'  => $value->added_dtime,
						'segid'  => encode_url($value->segment_id),
						'name'  => $value->segment_name,
						'status'  => $value->status,
						'added_by'  => $value->added_by,
						'edited_dtime'  => ($value->edited_dtime != '') ? $value->edited_dtime : 'NA'
					);
				}

				//print_obj($this->data['list_data']);die;

			} else {
				$this->data['list_data'] = '';
			}
			$this->load->view('segments/vw_segment_list', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onCheckDuplicateSegment()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$name = xss_clean($this->input->post('name'));

				$if_exists = $this->am->getSegmentData(array('segment_name ' => $name), FALSE);
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

	public function onGetSegmentEdit()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'Edit Segment';
			$segment_id = decode_url(xss_clean($this->uri->segment(2)));
			$chkdata = array(
				'segment_id'  => $segment_id
			);
			$getdata = $this->am->getSegmentData($chkdata, FALSE);
			if (!empty($getdata)) {
				$this->data['edit_data'] = array(
					'dtime'  => $getdata->added_dtime,
					'segid'  => encode_url($getdata->segment_id),
					'name'  => $getdata->segment_name,
					'status'  => $getdata->status,
					'added_by'  => $getdata->added_by,
					'edited_dtime'  => ($getdata->edited_dtime != '') ? $getdata->edited_dtime : 'NA'
				);
				//print_obj($this->data['edit_data']);die;
				$this->load->view('segments/vw_segment_edit', $this->data, false);
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function onChangeSegment()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'Segment';
			$segment_id = decode_url(xss_clean($this->input->post('seg_id')));
			$chkdata = array('segment_id'  => $segment_id);

			$name = xss_clean($this->input->post('name'));

			// print_obj($upd_userdata);die;

			$custdata = $this->am->getSegmentData($chkdata, FALSE);
			if (!empty($custdata)) {
				//update

				$upd_data = array(
					'segment_name'  => $name,
					'edited_dtime'  => dtime,
					'edited_by'  => $this->session->userdata('userid')
				);

				$upduser = $this->am->updateSegment($upd_data, $chkdata);
				if ($upduser) {
					$this->data['update_success'] = 'Successfully updated.';
					//list

					$dataUpd = $this->am->getSegmentData($chkdata, FALSE);
					$this->data['edit_data'] = array(
						'dtime'  => $dataUpd->added_dtime,
						'segid'  => encode_url($dataUpd->segment_id),
						'name'  => $dataUpd->segment_name,
						'status'  => $dataUpd->status,
						'added_by'  => $dataUpd->added_by,
						'edited_dtime'  => ($dataUpd->edited_dtime != '') ? $dataUpd->edited_dtime : 'NA'
					);
				} else {
					$this->data['update_failure'] = 'Not updated!';
				}

				$this->load->view('segments/vw_segment_edit', $this->data, false);
			} else {
				redirect(base_url());
			}
		} else {
			redirect(base_url());
		}
	}

	public function onCreateSegmentView()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			$this->data['page_title'] = 'Segment';
			$this->load->view('segments/vw_segment_add', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onCreateSegment()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$this->form_validation->set_rules('name', 'Segment Name', 'trim|required|xss_clean|htmlentities');

				if ($this->form_validation->run() == FALSE) {
					$this->form_validation->set_error_delimiters('', '');
					$return['errors'] = validation_errors();
					$return['added'] = 'rule_error';
				} else {

					$name = xss_clean($this->input->post('name'));
					$chkdata = array('segment_name '  => $name);
					$getdata = $this->am->getSegmentData($chkdata, FALSE);

					if (!$getdata) {

						//add
						$ins_data = array(
							'segment_name '  => $name,
							'added_dtime'  => dtime,
							'added_by'  => $this->session->userdata('userid')
						);
						// print_obj($ins_data);die;
						$addcust = $this->am->addSegment($ins_data);

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

	public function onDeleteSegment()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1 && $this->session->userdata('usergroup') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$segment_id  = decode_url(xss_clean($this->input->post('delid')));
				$getdata = $this->am->getSegmentData(array('segment_id'  => $segment_id), FALSE);

				if (!empty($getdata)) {
					//del
					$del = $this->am->delSegment(array('segment_id' => $segment_id));

					if ($del) {
						$return['deleted'] = 'success';
					} else {
						$return['deleted'] = 'failure';
					}
					// }
					// else{
					// 	$return['deleted'] = 'billed';
					// }



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
