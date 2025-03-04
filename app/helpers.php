<?php
use App\Models\News;
use App\Models\Notice;
use App\Models\AdmissionNotice;
use App\Models\CampusGalary;
use App\Models\Events;

function Getnews()
{
    $news =  News::where('news_status', 1)->orderBy('news_date', 'desc')->get();
    return $news;
}

function GetEvents()
{
    $events =  Events::where('status', 1)->orderBy('event_date', 'desc')->get();
    return $events;
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

function GetCampusGalary()
{
    $campusGalary =  CampusGalary::orderBy('created_at', 'desc')->get();
    return $campusGalary;
}