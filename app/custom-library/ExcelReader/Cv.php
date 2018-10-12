<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 6/4/14
 * Time: 10:03 AM
 */

class Cv {

    /**
     * Current Excel Sheet
     * @var array
     */
    private $currentSheet;

    /**
     * Contain records of excel sheet
     * @var array
     */
    private $rows;

    /**
     * Caption from spreadsheet
     * @var array
     */
    private $captions;

    /**
     * Sub caption from spreadsheet
     * @var array
     */
    private $subCaptions;

    /**
     * To track job indexes only
     * @var array
     */
    private $jobs;

    /**
     * To track education indexes only
     * @var array
     */
    private $edu;

    /**
     * To track Professional qualifications only
     * @var array
     */
    private $pqs;

    /**
     * To track Specialization only
     * @var array
     */
    private $spec;

    /**
     * Constant
     * @var string
     */
    protected static $JOB = 'Job';
    protected static $EDU = 'Edu';
    protected static $PQ = 'PQ';
    protected static $SPEC = 'Spec';
    protected static $NAME_INDEX = 2;
    protected static $PHOTO_INDEX = 3;
    protected static $PHONE_INDEX = 3;
    protected static $EMAIL_INDEX = 5;
    protected static $YOE_INDEX = 6;
    protected static $GENDER_INDEX = 50;

    public function __construct($currentSheet)
    {
        $this->currentSheet = $currentSheet;
        $this->rows         = $currentSheet['cells'];
        $this->captions     = $this->currentSheet['cells'][3];
        $this->subCaptions  = $this->currentSheet['cells'][4];
    }

    public function getIndex()
    {

        $tempId = 0;
        $tempEduId = 0;
        $tempPQId = 0;
        $tempSepcId = 0;

        foreach($this->captions as $captionkey=>  $caption)
        {
            // for job
            if(str_contains($caption,self::$JOB))
            {
                $tempId = $captionkey;
                $this->jobs[$captionkey]['title'] = $caption;
                $this->jobs[$captionkey]['caption'] = $caption;

            }

            if($captionkey >= $tempId)
            {
                if(!empty($this->jobs[$tempId]))
                {
                    if(preg_match('/'.$this->jobs[$tempId]['caption'].'/',$this->subCaptions[$captionkey]))
                    {
                        $this->jobs[$tempId]['values'][$captionkey] = array('key'=>$captionkey,'value'=>$this->subCaptions[$captionkey]);
                    }
                }
            }

            // for edu
            if(str_contains($caption,self::$EDU))
            {
                $caps = explode("_",$caption);
                $tempEduId = $captionkey;
                $this->edu[$captionkey]['title'] = $caps[1];
                $this->edu[$captionkey]['caption'] = $caps[0];
            }

            if($captionkey >= $tempEduId)
            {
                if(!empty($this->edu[$tempEduId]))
                {
                    if(preg_match('/'.$this->edu[$tempEduId]['caption'].'/',$this->subCaptions[$captionkey]))
                    {
                        $this->edu[$tempEduId]['values'][$captionkey] = array('key'=>$captionkey,'value'=>$this->subCaptions[$captionkey]);
                    }
                }
            }

            // for pqs
            if(str_contains($caption,self::$PQ))
            {
                $caps = explode("_",$caption);
                $tempPQId = $captionkey;
                $this->pqs[$captionkey]['title'] = (is_array($caps) && (!empty($caps)))? $caps[1] : $caption;
                $this->pqs[$captionkey]['caption'] = (is_array($caps) && (!empty($caps)))? $caps[0] : $caption;
            }

            if($captionkey >= $tempPQId)
            {
                if(!empty($this->pqs[$tempPQId]))
                {
                    if(preg_match('/'.$this->pqs[$tempPQId]['caption'].'/',$this->subCaptions[$captionkey]))
                    {
                        $this->pqs[$tempPQId]['values'][$captionkey] = array('key'=>$captionkey,'value'=>$this->subCaptions[$captionkey]);
                    }
                }
            }

            // for spec
            if(str_contains($caption,self::$SPEC))
            {
                $caps = explode("_",$caption);
                $tempSepcId = $captionkey;
                $this->spec[$captionkey]['title'] = (is_array($caps) && (!empty($caps)))? $caps[1] : $caption;
                $this->spec[$captionkey]['caption'] = (is_array($caps) && (!empty($caps)))? $caps[0] : $caption;
            }

            if($captionkey >= $tempSepcId)
            {
                if(!empty($this->spec[$tempSepcId]))
                {
                    if(preg_match('/'.$this->spec[$tempSepcId]['caption'].'/',$this->subCaptions[$captionkey]))
                    {
                        $this->spec[$tempSepcId]['values'][$captionkey] = array('key'=>$captionkey,'value'=>$this->subCaptions[$captionkey]);
                    }
                }
            }

        }
    }

    public function SaveCv()
    {
        
        error_reporting(E_ALL);
        $data = array();
$successCount=0;
$failedCount=0;
//Helpers::debug($this->rows);die();
        if(!empty($this->rows))
        {
            foreach($this->rows as $i => $row)
            {

                if($i>4)
                {
                    // reading record after caption rows

                    /*$data[$i]['name'] = $row[2];
                    $data[$i]['mobile'] = $row[3];
                    $data[$i]['email'] = $row[4];
                    $data[$i]['year_of_exp'] = $row[5];
                    $data[$i]['dob'] = $row[48];
                    $data[$i]['gender'] = $row[49];*/

                    $mobileNumber = !empty($row[self::$PHONE_INDEX])? substr(trim($row[self::$PHONE_INDEX]),0,10) :"";

                    // user name is now mobile number 11 digit with 0 at first.
                    $username = (preg_match('/^0+/',$mobileNumber))? $mobileNumber : '0'.$mobileNumber;
                    if(strlen($username) == 11)
                    {
                          $user = User::firstOrNew(array('username'=>$username));
                          if(!$user->exists)
                          {

                              $email=!empty($row[self::$EMAIL_INDEX])?trim($row[self::$EMAIL_INDEX]):"";
                              $yoe=!empty($row[self::$YOE_INDEX])?trim($row[self::$YOE_INDEX]):"";
                              $photo=!empty($row[self::$PHOTO_INDEX])?trim($row[self::$PHOTO_INDEX]):"";
                              $name=!empty($row[self::$NAME_INDEX])?trim($row[self::$NAME_INDEX]):"";
                              $gender=!empty($row[self::$GENDER_INDEX])?trim($row[self::$GENDER_INDEX]):"";
                              
                              $cvTable = new CvTable();
                              $cvTable->name         = trim($name);
                              $cvTable->mobile       = trim($username);
                              $cvTable->email        = $email ;
                              $cvTable->year_of_exp  = $yoe;
                              $cvTable->dob          = Helpers::dateTimeFormat("Y-m-d",trim($row[48]));
                              $cvTable->gender       = trim($gender);

                              $cvTable->save();

                              if($cvTable->cv_tbl_id)
                              {
                                  $candidate = new Candidate();
                                  $candidate->firstname = $cvTable->name;
                                  $candidate->email = $cvTable->email;
                                  $candidate->gender = $cvTable->gender;
                                  $candidate->dob = $cvTable->dob;
                                  $candidate->photo=$photo;
                                  $candidate->cv_tbl_id = $cvTable->cv_tbl_id;
                                  $candidate->save();

                                  $user->password = md5($username);
                                  $user->user_status = 1;
                                  $user->user_type = 'Candidate';
                                  $user->user_id = $candidate->candidate_id;
                                  $user->save();

                              }

                              foreach($this->jobs as $j=> $job)
                              {
                                  $jobObj = new CvJob();
                                  $jobObj->cv_tbl_id = $cvTable->cv_tbl_id;
                                  $jobObj->title = $job['title'];

                                  $data[$i]['jobs'][$j]['title'] = $job['caption'];
                                  foreach($job['values'] as  $value)
                                  {
                                      $names = explode("_",strtolower(trim($value['value'])));
                                      $name = str_replace(" ","_",$names[1]);
                                      $data[$i]['jobs'][$j]['values'][$value['key']][$name] = (!empty($row[$value['key']]))? $row[$value['key']] : '';
                                      $jobObj->{$name} = (!empty($row[$value['key']]))? $row[$value['key']] : '';

                                  }
                                  if(!empty($jobObj->company_name))
                                  {
                                      $jobObj->save();
                                  }

                              }

                              foreach($this->edu as $e => $edu)
                              {
                                  $eduObj = new CvEdu();
                                  $eduObj->cv_edu_title = $edu['title'];
                                  $eduObj->cv_tbl_id = $cvTable->cv_tbl_id;

                                  $data[$i]['edus'][$e]['title'] = $edu['caption'];
                                  foreach($edu['values'] as  $evalue)
                                  {
                                      $names = explode("_",strtolower(trim($evalue['value'])));
                                      $name = str_replace(" ","_",$names[1]);
                                      $data[$i]['edus'][$e]['values'][$evalue['key']][$name] = (!empty($row[$evalue['key']]))? $row[$evalue['key']] : '';
                                      $eduObj->{$name} = (!empty($row[$evalue['key']]))? $row[$evalue['key']] : '';
                                  }
if(!empty($eduObj->major) && !empty($eduObj->institution) &&!empty($eduObj->result) && !empty($eduObj->passing_year))
                                  {
                                  $eduObj->save();
                                  }
                              }

                              foreach($this->pqs as $p => $pq)
                              {
                                  $pqObj = new CvQualification();
                                  $pqObj->cv_q_title = $pq['title'];
                                  $pqObj->cv_tbl_id = $cvTable->cv_tbl_id;

                                  $data[$i]['pqs'][$p]['title'] = $pq['caption'];
                                  foreach($pq['values'] as  $pvalue)
                                  {
                                      $names = explode("_",strtolower(trim($pvalue['value'])));
                                      $name = str_replace(" ","_",$names[1]);
                                      $data[$i]['pqs'][$p]['values'][$pvalue['key']][$name] = (!empty($row[$pvalue['key']]))? $row[$pvalue['key']] : '';
                                      $pqObj->{$name} = (!empty($row[$pvalue['key']]))? $row[$pvalue['key']] : '';
                                  }

                                  if(!empty($pqObj->certificates)&&!empty($pqObj->institution)&&!empty($pqObj->finished_year))
                                  {
                                   $pqObj->save();
                                  }
                              }

                              foreach($this->spec as $s => $spe)
                              {

                                  $data[$i]['specs'][$s]['title'] = $spe['caption'];
                                  $specs = array();
                                  foreach($spe['values'] as  $specvalue)
                                  {
                                      $names = explode("_",strtolower(trim($specvalue['value'])));
                                      $name = str_replace(" ","_",$names[1]);
                                      $data[$i]['specs'][$s]['values'][$specvalue['key']][$name] = (!empty($row[$specvalue['key']]))? $row[$specvalue['key']] : '';
                                      $specs[$name] = (!empty($row[$specvalue['key']]))? $row[$specvalue['key']] : '';

                                      $specObj = new CvSpecialization();
                                      $specObj->cv_tbl_id = $cvTable->cv_tbl_id;
                                      $specObj->key = $name;
                                      $specObj->value = (!empty($row[$specvalue['key']]))? $row[$specvalue['key']] : '';

                                      if((!empty($specObj->key)) && (!empty($specObj->value)) && (strtolower($specObj->value) == 'yes'))
                                         $specObj->save();
                                  }

                              }
				//Helpers::addMessage(200, 'Successfully cv imported');
                                 $successCount++;
                          }else{
				//Helpers::addMessage(400, 'User already Exist');
                                $failedCount++;
                             // echo 'User already Exist';
                          }
                    }else{
					//Helpers::addMessage(400, 'less than 11 digit');
                             // echo 'less than 11 digit';
                        $failedCount++;
                    }


                }
            }
            
            Helpers::addMessage(200, "$successCount records imported and $failedCount records already exist");
            return 1;
        }else{
            return 0;
        }
    }

} 