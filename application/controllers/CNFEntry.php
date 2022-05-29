<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CNFEntry extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
	}

	public function index()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			$this->data['page_title'] = 'CNF Entry';
			$custdata = $this->am->getCNFEntryUserData(array('status' => 1), TRUE);
			if (!empty($custdata)) {
				foreach ($custdata as $key => $value) {
					if ($value->is_billed == 1) {
						$cnf_user = $this->am->getUserData(array('user_id' => $value->billled_for_dealer_user_id));
					} else {
						$cnf_user = [];
					}

					$this->data['comp_data'][] = array(
						'dtime'  => $value->added_dtime,
						'rwid'  => encode_url($value->entry_id),
						'name'  => $value->name,
						'full_name'  => $value->full_name,
						'vin_no'  => $value->vin_no,
						'status'  => $value->status,
						'added_by'  => $value->added_by,
						'is_billed'  => $value->is_billed,
						'is_dealer_billed'  => $value->is_dealer_billed,
						'dealer_billed_text'  => ($value->is_billed_to_cust == 1) ? 'Customer on ' . $value->dealer_billed_dtime : 'Sub Dealer on ' . $value->dealer_billed_dtime,
						'cnf_full_name'  => (!empty($cnf_user)) ? $cnf_user->full_name : '',
						'edited_dtime'  => ($value->edited_dtime != '') ? $value->edited_dtime : 'NA'
					);
				}

				//print_obj($this->data['comp_data']);die;

			} else {
				$this->data['comp_data'] = '';
			}
			$this->load->view('cnf/vw_list', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onCheckDuplicate()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$name = xss_clean($this->input->post('name'));

				$if_exists = $this->am->getCNFEntryData(array('vin_no' => $name), FALSE);
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

			$this->data['page_title'] = 'Edit CNF Entry';
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
					'manual_no'  => $getdata->manual_no,
					'battery_sl1'  => $getdata->battery_sl1,
					'battery_sl2'  => $getdata->battery_sl2,
					'battery_sl3'  => $getdata->battery_sl3,
					'battery_sl4'  => $getdata->battery_sl4,
					'battery_sl5'  => $getdata->battery_sl5,
					'battery_sl6'  => $getdata->battery_sl6,
					'status'  => $getdata->status,
					'added_by'  => $getdata->added_by,
					'is_billed'  => $getdata->is_billed,
					'edited_dtime'  => ($getdata->edited_dtime != '') ? $getdata->edited_dtime : 'NA'
				);
				//print_obj($this->data['comp_data']);die;
				$this->load->view('cnf/vw_edit', $this->data, false);
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

			$this->data['page_title'] = 'CNF Entry';
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
			$manual_no = xss_clean($this->input->post('manual_no'));
			$battery_sl1 = xss_clean($this->input->post('battery_sl1'));
			$battery_sl2 = xss_clean($this->input->post('battery_sl2'));
			$battery_sl3 = xss_clean($this->input->post('battery_sl3'));
			$battery_sl4 = xss_clean($this->input->post('battery_sl4'));
			$battery_sl5 = xss_clean($this->input->post('battery_sl5'));
			$battery_sl6 = xss_clean($this->input->post('battery_sl6'));

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
					'manual_no'  => $manual_no,
					'battery_sl1'  => $battery_sl1,
					'battery_sl2'  => $battery_sl2,
					'battery_sl3'  => $battery_sl3,
					'battery_sl4'  => $battery_sl4,
					'battery_sl5'  => $battery_sl5,
					'battery_sl6'  => $battery_sl6,
					'edited_dtime'  => dtime,
					'edited_by'  => $this->session->userdata('userid')
				);

				$upduser = $this->am->updateCNFEntry($upd_data, $chkdata);

				redirect(base_url('cnf/edit/' . encode_url($entry_id)));
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

			$this->data['page_title'] = 'CNF Entry';

			$userdata = $this->am->getUserData(array('user_id !=' => 1, 'user_group ' => 2), TRUE);

			if ($userdata) {
				foreach ($userdata as $key => $value) {
					$this->data['user_data'][] = array(
						'userid'  => $value->user_id,
						'fullname'  => $value->full_name
					);
				}

				//print_obj($this->data['user_data']);die;

			} else {
				$this->data['user_data'] = '';
			}


			$this->load->view('cnf/vw_add', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onCreate()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('et_invoice_no', 'ET Invoice No', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('et_invoice_date', 'ET Invoice Date', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('model', 'Model', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('color', 'Color', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('vin_no', 'Vin No', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('motor_no', 'Motor No', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('converter_no', 'Converter No', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('controller_no', 'Controller No', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('charger_no', 'Charger No', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('manual_no', 'Manual No', 'trim|required|xss_clean|htmlentities');
				$this->form_validation->set_rules('battery_sl1', 'Battery Sl 1', 'trim|required|xss_clean|htmlentities');

				if ($this->form_validation->run() == FALSE) {
					$this->form_validation->set_error_delimiters('', '');
					$return['errors'] = validation_errors();
					$return['added'] = 'rule_error';
				} else {

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
					$manual_no = xss_clean($this->input->post('manual_no'));
					$battery_sl1 = xss_clean($this->input->post('battery_sl1'));
					$battery_sl2 = xss_clean($this->input->post('battery_sl2'));
					$battery_sl3 = xss_clean($this->input->post('battery_sl3'));
					$battery_sl4 = xss_clean($this->input->post('battery_sl4'));
					$battery_sl5 = xss_clean($this->input->post('battery_sl5'));
					$battery_sl6 = xss_clean($this->input->post('battery_sl6'));

					if ($this->session->userdata('usergroup') == 1) {
						$created_user = xss_clean($this->input->post('created_user'));
					} else {
						$created_user = $this->session->userdata('userid');
					}
					$chkdata = array('vin_no'  => $vin_no);
					$getdata = $this->am->getCNFEntryData($chkdata, FALSE);

					if (!$getdata) {

						//add
						$ins_data = array(
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
							'manual_no'  => $manual_no,
							'battery_sl1'  => $battery_sl1,
							'battery_sl2'  => $battery_sl2,
							'battery_sl3'  => $battery_sl3,
							'battery_sl4'  => $battery_sl4,
							'battery_sl5'  => $battery_sl5,
							'battery_sl6'  => $battery_sl6,
							'added_dtime'  => dtime,
							'added_by'  => $created_user
						);
						// print_obj($ins_data);die;
						$addcust = $this->am->addCNFEntry($ins_data);

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

	public function onDelete()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1 && $this->session->userdata('usergroup') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

				$entry_id  = decode_url(xss_clean($this->input->post('delid')));
				$getdata = $this->am->getCNFEntryData(array('entry_id'  => $entry_id), FALSE);

				if (!empty($getdata)) {
					//del
					$del = $this->am->delCNFEntry(array('entry_id' => $entry_id));

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

	public function cellColor($objPHPExcel, $cell, $text, $color)
	{

		$styleArray = array(
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => $color),
				'size'  => 10,
				'name'  => 'Verdana'
			)
		);

		$objPHPExcel->getActiveSheet()->getCell($cell)->setValue($text);
		$objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($styleArray);
	}



	public function onUploadCNFEntry()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {

			if ($this->input->post('submit')) {

				$path = './uploads/cnfentry/';
				//echo  $path;die;

				$config['upload_path'] = $path;
				$config['allowed_types'] = 'xlsx|xls|csv';
				$config['remove_spaces'] = TRUE;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('uploadFile')) {
					$error = array('error' => $this->upload->display_errors());
				} else {
					$data = array('upload_data' => $this->upload->data());
				}

				// print_obj($data);die;

				if (empty($error)) {
					if (!empty($data['upload_data']['file_name'])) {
						$import_xls_file = $data['upload_data']['file_name'];
					} else {
						$import_xls_file = 0;
					}

					$inputFileName = $path . $import_xls_file;
					
					try {
						$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
						$objReader = PHPExcel_IOFactory::createReader($inputFileType);
						$objPHPExcel = $objReader->load($inputFileName);
						$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
						$flag = true;

						print_obj($allDataInSheet);die;
						$xl_length = count($allDataInSheet[1]);
						//echo $xl_length;die;

						$my_header = array(
							'Created',
							'Name',
							'Email address',
							'Phone number',
							'Stage',
							'Owner',
							'Source',
							'Labels'
						);
						$ar_length = count($my_header);

						if ($xl_length == $ar_length) {

							$excel_header = array(
								$allDataInSheet[1]['A'],
								$allDataInSheet[1]['B'],
								$allDataInSheet[1]['C'],
								$allDataInSheet[1]['D'],
								$allDataInSheet[1]['E'],
								$allDataInSheet[1]['F'],
								$allDataInSheet[1]['G'],
								$allDataInSheet[1]['H']
							);

							$diff = array_diff($my_header, $excel_header);
							//print_obj($diff);

							//print_obj($allDataInSheet);die;
							if (empty($diff)) {
								foreach ($allDataInSheet as $value) {
									if ($flag) {
										$flag = false;
										continue;
									}
									$data = array(
										'lead_created' => $value['A'],
										'name' => $value['B'],
										'email' => $value['C'],
										'phone' => $value['D'],
										'stage' => $value['E'],
										'owner' => $value['F'],
										'source' => $value['G'],
										'lebels' => $value['H'],
										'added_user' => $this->session->userdata('userid'),
										'created_dtime' => dtime
									);
									//print_obj($data);die;

									$chkdata = array(
										'name' => $value['B'],
										'email' => $value['C'],
										'phone' => $value['D']
									);

									$leaddata = $this->am->getCNFEntryData($chkdata, FALSE);
									if ($leaddata) {
										$result = $this->am->updateCNFEntry($data, $chkdata);
									} else {
										$result = $this->am->addCNFEntry($data);
									}
								}


								if ($result) {
									$this->data['import_status'] = "success";
								} else {
									$this->data['import_status'] = "error";
								}
							} else {
								$this->data['import_status'] = "Mismatch in Excel Column Names!";
							}
						} else {
							$this->data['import_status'] = "Mismatch in Excel Column Header!";
						}
					} catch (Exception $e) {
						$this->data['import_status'] = 'Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
							. '": ' . $e->getMessage();
					}
				} else {
					$this->data['import_status'] = 'Error2';
				}
			}
			// $this->load->view('main/vw_fbleads2', $this->data, false);
		} else {
			redirect(base_url());
		}
	}

	public function onGetBMXLSX()
	{
		if (!empty($this->session->userdata('userid')) && $this->session->userdata('usr_logged_in') == 1) {
			if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {
				// create file name
				$fileName = 'BMReport-' . dtime2 . '.xlsx';
				$filepath = ABS_PATH . 'ExportedData/' . $fileName;
				$downfpath = base_url() . 'common/ExportedData/' . $fileName;
				//echo $filepath ;die;

				$date_from = xss_clean($this->input->post('date_from'));
				$date_to = xss_clean($this->input->post('date_to'));
				// $business_model = xss_clean($this->input->post('business_model'));

				$date_from = date_create($date_from);
				$date_from = date_format($date_from, "Y-m-d");

				$date_to = date_create($date_to);
				$date_to = date_format($date_to, "Y-m-d");

				$param = array(
					'date(ADDTIME(leads.date_entered, TIME("05:30:00"))) >=' => $date_from,
					'date(ADDTIME(leads.date_entered, TIME("05:30:00"))) <=' => $date_to,
					'leads.deleted' => 0
				); //to match IST

				$leadsData = $this->mm->getLeadsReport($p = $param, $many = TRUE);
				//print_obj($leadsData);die;

				if (!empty($leadsData)) {
					$objPHPExcel = new PHPExcel();
					$objPHPExcel->setActiveSheetIndex(0);

					$rowCount = 0;
					$sum_total_leads = 0;
					$sum_total_not_called_leads = 0;
					$sum_total_called_leads = 0;
					$sum_total_converted_leads = 0;
					$sum_converted_leads_per = 0;

					$owner_name = '';
					$owner_name_sum = '';
					$header_title = '';

					foreach ($leadsData as $value) {


						if ($header_title != $value->Business_model_c) {
							if ($value->Business_model_c == 'b2b') {
								$bm_name = 'B2B';
							} elseif ($value->Business_model_c == 'b2c') {
								$bm_name = 'B2C';
							} else {
								$bm_name = 'Others';
							}
							$rowCount++;
							$objPHPExcel->getActiveSheet()->SetCellValue('A' . ++$rowCount, $bm_name . ' LEAD SUMMARY');
							$header_title = $value->Business_model_c;
							//$rowCount++;
						}

						// set Header
						if ($value->owner_c != $owner_name) {
							$rowCount++;
							$objPHPExcel->getActiveSheet()->SetCellValue('A' . ++$rowCount, $value->owner_c);
							$objPHPExcel->getActiveSheet()->SetCellValue('A' . ++$rowCount, 'Date');
							$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'Total Leads');
							$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, 'Not called leads');
							$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, 'Called leads');
							$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'Converted leads');
							$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, 'Converted leads %');

							$rowCount++;
							$owner_name = $value->owner_c;
						}

						// set Row
						$converted_leads_per = (round(($value->total_converted_leads / $value->total_leads) * 100, 2));
						$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->date_entered);
						$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->total_leads);
						$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->total_not_called_leads);
						$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->total_called_leads);
						$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->total_converted_leads);
						$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $converted_leads_per);
						$rowCount++;

						// set total
						if ($value->owner_c != $owner_name_sum) {
							$sum_total_leads = 0;
							$sum_total_not_called_leads = 0;
							$sum_total_called_leads = 0;
							$sum_total_converted_leads = 0;
							$sum_converted_leads_per = 0;
						}
						$sum_total_leads += $value->total_leads;
						$sum_total_not_called_leads += $value->total_not_called_leads;
						$sum_total_called_leads += $value->total_called_leads;
						$sum_total_converted_leads += $value->total_converted_leads;
						$sum_converted_leads_per = round(($sum_total_converted_leads / $sum_total_leads) * 100, 2);

						$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'Total');
						$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $sum_total_leads);
						$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $sum_total_not_called_leads);
						$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $sum_total_called_leads);
						$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $sum_total_converted_leads);
						$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $sum_converted_leads_per);

						$owner_name_sum = $value->owner_c;
						//$rowCount++;


					}
					$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
					$objWriter->save($filepath);
					// download file
					//header("Content-Type: application/vnd.ms-excel");
					//redirect($downfpath);
					$return['export'] = 'success';
					$return['downpath'] = $downfpath;
					$return['tableData'] = $leadsData;
				} else {
					$return['export'] = 'failure';
					$return['downpath'] = 0;
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
