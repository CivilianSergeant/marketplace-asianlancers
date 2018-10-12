<?php
/**
 * Created by PhpStorm.
 * User: Himel
 * Date: 6/8/14
 * Time: 3:17 PM
 */

class CvDownload extends PDFPage{

public function setHeader($info,$theme,$type)
    {
        $name = $info->firstname.''.$info->lastname;
        $this->SetFont('Arial','',18);
        $this->Cell(120,10,strtoupper($name),0,1,'L');
        $this->SetFontSize(10);
        if($type!="Employer"){
        $this->Cell(120,6,'Address : '.$info->current_address,0,1,'L');
        $this->Cell(120,6,'Mobile : '.$info->mobile,0,1,'L');
        $this->Cell(120,6,'E-mail : '.$info->email,0,1,'L');
        }
        $image = '';
        if(!empty($info->photo) && file_exists('data/profile/'.$info->photo)){
            $image = url('/').'/data/profile/'.$info->photo;
        }else{
            $image = $theme.'images/FB-profile-avatar.jpg';
        }
        $this->Image($image,170,10,30,33);
        $this->SetY(40);
        $this->Cell(190,6,'',"B",1,"C");


    }


    public function employmentHistory($jobs,$cvTbl)
    {

       // Helpers::debug($jobs);
        $this->SetFillColor(230,230,230);
        $this->SetY(47);
        $this->SetFont('Arial','BU',10);
        $this->Cell(190,6,'Employment History: ',0,1,'L',1);
        $this->SetFont('Arial','B',10);
        $this->Cell(190,8, 'Total year of experience : '.$cvTbl->year_of_exp,0,1,"L");
        if(count($jobs))
        {
            foreach($jobs as $j => $job){
                $this->SetFont('Arial','BU',10);

                $this->Cell(190,6,($j+1).". ".$job->title." ( ".$job->start." - ".$job->end.")",0,1,"L");
                $this->SetFont('Arial','B',10);
                $this->Cell(190,6, $job->company_name,0,1,"L");
                $this->SetFont('Arial','',10);
                $this->Cell(190,6,"Designation : ".$job->designation,0,1,"L");
                $this->Cell(190,6,"Department : ".$job->department,0,1,"L");
                $this->Cell(190,5,"",0,1,"L");
            }
        }
    }

    public function academicQualification($edus)
    {


        $this->SetFont('Arial','BU',10);
        $this->Cell(190,6,'Academic Qualification: ',0,1,'L',1);

        $this->SetFont('Arial','B',10);
        $this->Cell(190,2,"", 0,1,"L");
        $this->Cell(38,8,"Exam Title","T,L",0,"C");
        $this->Cell(38,8,"Concentration/Major","T,L",0,"C");
        $this->Cell(38,8,"Institute","T,L",0,"C");
        $this->Cell(38,8,"Result","T,L",0,"C");
        $this->Cell(38,8,"Pass Year","T,L,R",1,"C");

        if(count($edus)){
            foreach($edus as $e => $edu){
                $this->SetFont('Arial','',10);
                $this->Cell(38,8,$edu->cv_edu_title,"T,B,L",0,"C");
                $this->Cell(38,8,$edu->major,"T,B,L",0,"C");
                $this->Cell(38,8,$edu->institution,"T,B,L",0,"C");
                $this->Cell(38,8,$edu->result,"T,B,L",0,"C");
                $this->Cell(38,8,$edu->passing_year,"T,B,L,R",1,"C");
            }
        }



    }

    public function professionalQualification($qualifications)
    {

        $this->Cell(190,2,"", 0,1,"L");
        $this->SetFont('Arial','BU',10);
        $this->Cell(190,6,'Professional Qualification: ',0,1,'L',1);

        $this->SetFont('Arial','B',10);
        $this->Cell(190,2,"", 0,1,"L");
        $this->Cell(63.33,8,"Certification","T,L",0,"C");
        $this->Cell(63.33,8,"Institute","T,L",0,"C");
        $this->Cell(63.33,8,"Location","T,L,R",1,"C");


        if(count($qualifications)){
            foreach($qualifications as $q => $quali){
                $this->SetFont('Arial','',10);
                $this->Cell(63.33,8,$quali->cv_q_title,"T,B,L",0,"C");
                $this->Cell(63.33,8,$quali->institution,"T,B,L",0,"C");
                $this->Cell(63.33,8,$quali->finished_year,"T,B,R,L",1,"C");
            }
        }

    }

    public function specialization($specs)
    {
        $this->Cell(190,2,"", 0,1,"L");
        $this->SetFont('Arial','BU',10);
        $this->Cell(190,6,'Specialization: ',0,1,'L',1);
        $this->SetFont('Arial','B',10);
        $this->Cell(190,2,"", 0,1,"L");
        $this->Cell(190,8,"Fields of Specialization ","T,L,B,R",1,"C");
        if(count($specs))
        {
            foreach($specs as $s => $spec){
                $this->SetFont('Arial','',10);
                if(count($specs)-1 == $s){
                    $this->Cell(190,8,($s+1).". ".str_replace("_"," ",$spec->key),"L,B,R",1,"L");
                }else{
                    $this->Cell(190,8,($s+1).". ".str_replace("_"," ",$spec->key),"L,R",1,"L");
                }
            }
        }
    }

    public function personalInfo($info)
    {
        $this->Cell(190,2,"", 0,1,"L");
        $this->SetFont('Arial','BU',10);
        $this->Cell(190,6,'Personal Details: ',0,1,'L',1);
        $this->SetFont('Arial','',10);
        $this->Cell(190,6, "Father's Name              : ".ucfirst($info->father_name),0,1,"L");
        $this->Cell(190,6, "Mother's Name              : ".ucfirst($info->mother_name),0,1,"L");
        $this->Cell(190,6, "Date of Birth                  : ".Helpers::dateTimeFormat('j F, Y',$info->dob),0,1,"L");
        $this->Cell(190,6, "Gender                          : ".ucfirst($info->gender),0,1,"L");
        $this->Cell(190,6, "Marital Status                : ".ucfirst($info->marital_status),0,1,"L");
        $this->Cell(190,6, "Nationality                     : ".ucfirst($info->nationality),0,1,"L");
        $this->Cell(190,6, "Religion                         : ".ucfirst($info->religion),0,1,"L");
        $this->Cell(190,6, "Permanent Address      : ".ucfirst($info->parmanent_address),0,1,"L");
        $this->Cell(190,6, "Current   Address         : ".ucfirst($info->current_address),0,1,"L");
    }

} 