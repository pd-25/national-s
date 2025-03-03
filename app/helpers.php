<?php
use App\Models\News;
use App\Models\Notice;
use App\Models\AdmissionNotice;

function Getnews()
{
    $news =  News::where('news_status', 1)->orderBy('news_date', 'desc')->get();
    return $news;
}

function Getnotice()
{
    $notice =  Notice::orderBy('notice_date', 'desc')->get();
    return $notice;
}

function GetAdmissionnotice()
{
    $admissionNotice =  AdmissionNotice::orderBy('admi_notice_date', 'desc')->get();
    return $admissionNotice;
}