<?php
use Illuminate\Http\Request;

function getDashboardNameFromUrlFirst($path)
{
    $segments = explode('/', $path);
    $dashboardNameFirst = $segments[count($segments) - 2];
    return $dashboardNameFirst;
}

function getDashboardNameFromUrlSecond($path)
{
    $segments = explode('/', $path);
    $dashboardNameSecond = end($segments);
    return $dashboardNameSecond;
}

function setActiveRoutePt1($name){
    return request()->routeIs($name) ? 'flex items-center w-full space-x-2 text-white bg-indigo-600 rounded-lg' : 'flex items-center space-x-2 text-indigo-600 transition-colors rounded-lg group hover:bg-indigo-600 hover:text-white';
}

function setActiveRoutePt2($name){
    return request()->routeIs($name) ? 'p-2 bg-indigo-700 rounded-lg' : 'p-2 transition-colors rounded-lg group-hover:bg-indigo-700 group-hover:text-white';
}

function setActiveRoutePt3($name){
    return request()->routeIs($name) ? 'text-white bg-indigo-600' : 'text-gray-500 bg-white';
}
