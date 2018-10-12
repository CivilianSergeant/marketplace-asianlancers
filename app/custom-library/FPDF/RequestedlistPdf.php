<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class RequestedlistPdf extends PDFPage{

    public function setHeader($info,$theme)
    {
        $name = $info->title;
        $this->SetFont('Arial','',18);
        $this->Cell(165,10,strtoupper($name),0,1,'C');
        $this->SetFontSize(10);
        
        $this->Cell(165,6,'Address : '.trim($info->address),0,1,'C');
        $this->Cell(165,6,'Mobile : '.$info->mobile,0,1,'C');
        $this->Cell(165,6,'E-mail : '.$info->email,0,1,'C');
        $image = '';
        if(!empty($info->photo_name) && file_exists('data/employer/'.$info->photo_name)){
            $image = url('/').'/data/employer/'.$info->photo_name;
        }else{
            $image = $theme.'images/FB-profile-avatar.jpg';
        }
        $this->Image($image,140,10,23,26);
        $this->SetY(35);
        $this->Cell(190,6,'',"B",1,"C");


    }
    
    public function requestedCandidate($requests)
    {

       // Helpers::debug($jobs);
        $this->SetFillColor(230,230,230);
        $this->SetY(47);
        $this->SetFont('Arial','BU',10);
        $this->Cell(190,6,'Requested candidate for interview: ',0,1,'L',1);

        $this->SetFont('Arial','B',10);
        $this->Cell(190,2,"", 0,1,"L");
        $this->Cell(38,8,"Name","T,L",0,"C");
        $this->Cell(38,8,"Phone","T,L",0,"C");
        $this->Cell(38,8,"Email","T,L",0,"C");
        $this->Cell(38,8,"Speciality","T,L",0,"C");
        $this->Cell(38,8,"Interview time","T,L,R",1,"C");

        $skills="";
        $times="";
        $timearr=array();
        if(count($requests)){
            foreach($requests as $e => $req){
                $this->SetFont('Arial','',7);
                $name = $req->Candidate->firstname .' '.$req->Candidate->lastname;
                $this->Cell(38,50,$name,"T,B,L",0,"C");
                $this->Cell(38,50,$req->Candidate->phone,"T,B,L",0,"C");
                $this->Cell(38,50,$req->Candidate->email,"T,B,L",0,"C");
                $specialization = $req->Candidate->CvTable->CvSpecialization;
                foreach($specialization as $spec){
                   $skills.=$spec->key."\n";
                }
                
                
                $availableTimes = $req->Candidate->UserAcc->Schedules; 
               
                foreach($availableTimes as $time){
                    array_push($timearr, $time->available_date.' '.$time->from_time.'-'.$time->to_time."\n") ;
                }
                
                
                $this->Cell(38,50,$skills,"T,B,L",0,"C");
                $this->Cell(38,50,  implode(" ", $timearr),"T,B,L,R",1,"C");
            }
        }
    }
    
    
     public function conCandidate($requests)
    {

       // Helpers::debug($jobs);
        $this->SetFillColor(230,230,230);
        $this->SetY(47);
        $this->SetFont('Arial','BU',10);
        $this->Cell(190,6,'Confirmed candidate for interview: ',0,1,'L',1);

        $this->SetFont('Arial','B',10);
        $this->Cell(190,2,"", 0,1,"L");
        $this->Cell(38,8,"Name","T,L",0,"C");
        $this->Cell(38,8,"Phone","T,L",0,"C");
        $this->Cell(38,8,"Email","T,L",0,"C");
        $this->Cell(38,8,"Speciality","T,L",0,"C");
        $this->Cell(38,8,"Interview time","T,L,R",1,"C");

        $skills="";
        $times="";
        $timearr=array();
        if(count($requests)){
            foreach($requests as $e => $req){
                $this->SetFont('Arial','',7);
                $name = $req->Candidate->firstname .' '.$req->Candidate->lastname;
                $this->Cell(38,50,$name,"T,B,L",0,"C");
                $this->Cell(38,50,$req->Candidate->phone,"T,B,L",0,"C");
                $this->Cell(38,50,$req->Candidate->email,"T,B,L",0,"C");
                $specialization = $req->Candidate->CvTable->CvSpecialization;
                foreach($specialization as $spec){
                   $skills.=$spec->key."\n";
                }
                
                
                $availableTimes = $req->Candidate->UserAcc->Schedules; 
               
                foreach($availableTimes as $time){
                    array_push($timearr, $time->available_date.' '.$time->from_time.'-'.$time->to_time."\n") ;
                }
                
                
                $this->Cell(38,50,$skills,"T,B,L",0,"C");
                $this->Cell(38,50,  implode(" ", $timearr),"T,B,L,R",1,"C");
            }
        }
    }



    
}
?>
