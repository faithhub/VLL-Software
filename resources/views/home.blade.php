{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts/dashboard/app')
@section('content')
    <div class="main-container container-fluid px-0">
        <!--Page header-->
        {{-- <div class="page-header">
            <div class="page-leftheader">
                <h4 class="page-title mb-0 text-primary">Dashboard</h4>
            </div>
            <div class="page-rightheader">
                <div class="btn-list"> <button class="btn btn-outline-primary"><i class="fe fe-download me-2"></i>
                        Import</button> <a href="javascript:void(0);" class="btn btn-primary btn-pill"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                            class="fa fa-calendar me-2 fs-14"></i>
                        Search By Date</a>
                    <div class="dropdown-menu border-0"> <a class="dropdown-item" href="javascript:void(0);">Today</a> <a
                            class="dropdown-item" href="javascript:void(0);">Yesterday</a> <a class="dropdown-item active"
                            href="javascript:void(0);">Last 7
                            days</a> <a class="dropdown-item" href="javascript:void(0);">Last 30
                            days</a> <a class="dropdown-item" href="javascript:void(0);">Last
                            Month</a> <a class="dropdown-item" href="javascript:void(0);">Last 6
                            months</a> <a class="dropdown-item" href="javascript:void(0);">Last
                            year</a> </div>
                </div>
            </div>
        </div> --}}
        <!--End Page header-->
        <!-- Row-1 -->
        {{-- <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden dash1-card border-0 dash1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class=""> <span class="fs-14 font-weight-normal">Total
                                        Sales</span>
                                    <h2 class="mb-2 mt-1 number-font carn1 font-weight-bold">
                                        3,257
                                    </h2> <span class=""><i class="fe fe-arrow-up-circle"></i>
                                        76%
                                        <span class="ms-1 fs-11">Growth This Month</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 my-auto mx-auto">
                                <div class="mx-auto text-right" style="position: relative;">
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 129px; height: 61px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden dash1-card border-0 dash2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class=""> <span class="fs-14">Total Stats</span>
                                    <h2 class="mb-2 mt-1 number-font carn2 font-weight-bold">
                                        1,678
                                    </h2> <span class=""><i class="fe fe-arrow-down-circle"></i>
                                        15%
                                        <span class="ms-1 fs-11">Loss This Month</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 my-auto mx-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden dash1-card border-0 dash3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class=""> <span class="fs-14">Total
                                        Income</span>
                                    <h2 class="mb-2 mt-1 number-font carn2 font-weight-bold">
                                        $2,590
                                    </h2> <span class=""><i class="fe fe-arrow-up-circle"></i>
                                        62%
                                        <span class="ms-1 fs-11">From Last Month</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 my-auto mx-auto">
                                <div class="mx-auto text-right" style="position: relative;">
                                    <div id="spark3" style="min-height: 60px;">
                                        <div id="apexcharts38glh4n4" class="apexcharts-canvas apexcharts38glh4n4 light"
                                            style="width: 120px; height: 60px;"><svg id="SvgjsSvg1423" width="120"
                                                height="60" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"
                                                xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                style="background: transparent;">
                                                <g id="SvgjsG1425" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(0, 0)">
                                                    <defs id="SvgjsDefs1424">
                                                        <clipPath id="gridRectMask38glh4n4">
                                                            <rect id="SvgjsRect1430" width="122" height="62"
                                                                x="-1" y="-1" rx="0"
                                                                ry="0" fill="#ffffff" opacity="1"
                                                                stroke-width="0" stroke="none" stroke-dasharray="0">
                                                            </rect>
                                                        </clipPath>
                                                        <clipPath id="gridRectMarkerMask38glh4n4">
                                                            <rect id="SvgjsRect1431" width="122" height="62"
                                                                x="-1" y="-1" rx="0"
                                                                ry="0" fill="#ffffff" opacity="1"
                                                                stroke-width="0" stroke="none" stroke-dasharray="0">
                                                            </rect>
                                                        </clipPath>
                                                        <linearGradient id="SvgjsLinearGradient1437" x1="0"
                                                            y1="0" x2="0" y2="1">
                                                            <stop id="SvgjsStop1438" stop-opacity="0.65"
                                                                stop-color="rgba(153,153,153,0.65)" offset="0"></stop>
                                                            <stop id="SvgjsStop1439" stop-opacity="0.5"
                                                                stop-color="rgba(153,153,153,0.5)" offset="1"></stop>
                                                            <stop id="SvgjsStop1440" stop-opacity="0.5"
                                                                stop-color="rgba(153,153,153,0.5)" offset="1"></stop>
                                                        </linearGradient>
                                                    </defs>
                                                    <line id="SvgjsLine1429" x1="0" y1="0"
                                                        x2="0" y2="60" stroke="#b6b6b6"
                                                        stroke-dasharray="3" class="apexcharts-xcrosshairs"
                                                        x="0" y="0" width="1" height="60"
                                                        fill="#b1b9c4" filter="none" fill-opacity="0.9"
                                                        stroke-width="1">
                                                    </line>
                                                    <g id="SvgjsG1443" class="apexcharts-xaxis"
                                                        transform="translate(0, 0)">
                                                        <g id="SvgjsG1444" class="apexcharts-xaxis-texts-g"
                                                            transform="translate(0, 1.875)">
                                                        </g>
                                                    </g>
                                                    <g id="SvgjsG1447" class="apexcharts-grid">
                                                        <line id="SvgjsLine1449" x1="0" y1="60"
                                                            x2="120" y2="60" stroke="transparent"
                                                            stroke-dasharray="0"></line>
                                                        <line id="SvgjsLine1448" x1="0" y1="1"
                                                            x2="0" y2="60" stroke="transparent"
                                                            stroke-dasharray="0"></line>
                                                    </g>
                                                    <g id="SvgjsG1433"
                                                        class="apexcharts-area-series apexcharts-plot-series">
                                                        <g id="SvgjsG1434" class="apexcharts-series"
                                                            seriesName="TotalxIncome" data:longestSeries="true"
                                                            rel="1" data:realIndex="0">
                                                            <path id="SvgjsPath1441"
                                                                d="M 0 60L 0 60C 1.826086956521739 60 3.391304347826087 37.41935483870968 5.217391304347826 37.41935483870968C 7.043478260869565 37.41935483870968 8.608695652173914 33.54838709677419 10.434782608695652 33.54838709677419C 12.26086956521739 33.54838709677419 13.826086956521738 37.41935483870968 15.652173913043477 37.41935483870968C 17.478260869565215 37.41935483870968 19.043478260869566 42.58064516129032 20.869565217391305 42.58064516129032C 22.695652173913043 42.58064516129032 24.26086956521739 -7.105427357601002e-15 26.08695652173913 -7.105427357601002e-15C 27.913043478260867 -7.105427357601002e-15 29.478260869565215 25.806451612903224 31.304347826086953 25.806451612903224C 33.130434782608695 25.806451612903224 34.69565217391304 20.645161290322577 36.52173913043478 20.645161290322577C 38.34782608695652 20.645161290322577 39.91304347826087 42.58064516129032 41.73913043478261 42.58064516129032C 43.565217391304344 42.58064516129032 45.130434782608695 25.16129032258064 46.95652173913043 25.16129032258064C 48.78260869565217 25.16129032258064 50.347826086956516 32.258064516129025 52.17391304347826 32.258064516129025C 54 32.258064516129025 55.565217391304344 47.74193548387097 57.391304347826086 47.74193548387097C 59.21739130434782 47.74193548387097 60.78260869565217 30.32258064516129 62.60869565217391 30.32258064516129C 64.43478260869564 30.32258064516129 66 30.96774193548387 67.82608695652173 30.96774193548387C 69.65217391304347 30.96774193548387 71.21739130434783 25.16129032258064 73.04347826086956 25.16129032258064C 74.8695652173913 25.16129032258064 76.43478260869566 35.483870967741936 78.26086956521739 35.483870967741936C 80.08695652173913 35.483870967741936 81.65217391304348 23.87096774193548 83.47826086956522 23.87096774193548C 85.30434782608695 23.87096774193548 86.8695652173913 44.516129032258064 88.69565217391303 44.516129032258064C 90.52173913043477 44.516129032258064 92.08695652173913 18.064516129032256 93.91304347826086 18.064516129032256C 95.7391304347826 18.064516129032256 97.30434782608695 40 99.13043478260869 40C 100.95652173913042 40 102.52173913043478 36.12903225806451 104.34782608695652 36.12903225806451C 106.17391304347825 36.12903225806451 107.73913043478261 34.83870967741935 109.56521739130434 34.83870967741935C 111.39130434782608 34.83870967741935 112.95652173913044 19.999999999999993 114.78260869565217 19.999999999999993C 116.6086956521739 19.999999999999993 118.17391304347825 27.096774193548384 119.99999999999999 27.096774193548384C 119.99999999999999 27.096774193548384 119.99999999999999 27.096774193548384 119.99999999999999 60M 119.99999999999999 27.096774193548384z"
                                                                fill="url(#SvgjsLinearGradient1437)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                                stroke-dasharray="0" class="apexcharts-area"
                                                                index="0" clip-path="url(#gridRectMask38glh4n4)"
                                                                pathTo="M 0 60L 0 60C 1.826086956521739 60 3.391304347826087 37.41935483870968 5.217391304347826 37.41935483870968C 7.043478260869565 37.41935483870968 8.608695652173914 33.54838709677419 10.434782608695652 33.54838709677419C 12.26086956521739 33.54838709677419 13.826086956521738 37.41935483870968 15.652173913043477 37.41935483870968C 17.478260869565215 37.41935483870968 19.043478260869566 42.58064516129032 20.869565217391305 42.58064516129032C 22.695652173913043 42.58064516129032 24.26086956521739 -7.105427357601002e-15 26.08695652173913 -7.105427357601002e-15C 27.913043478260867 -7.105427357601002e-15 29.478260869565215 25.806451612903224 31.304347826086953 25.806451612903224C 33.130434782608695 25.806451612903224 34.69565217391304 20.645161290322577 36.52173913043478 20.645161290322577C 38.34782608695652 20.645161290322577 39.91304347826087 42.58064516129032 41.73913043478261 42.58064516129032C 43.565217391304344 42.58064516129032 45.130434782608695 25.16129032258064 46.95652173913043 25.16129032258064C 48.78260869565217 25.16129032258064 50.347826086956516 32.258064516129025 52.17391304347826 32.258064516129025C 54 32.258064516129025 55.565217391304344 47.74193548387097 57.391304347826086 47.74193548387097C 59.21739130434782 47.74193548387097 60.78260869565217 30.32258064516129 62.60869565217391 30.32258064516129C 64.43478260869564 30.32258064516129 66 30.96774193548387 67.82608695652173 30.96774193548387C 69.65217391304347 30.96774193548387 71.21739130434783 25.16129032258064 73.04347826086956 25.16129032258064C 74.8695652173913 25.16129032258064 76.43478260869566 35.483870967741936 78.26086956521739 35.483870967741936C 80.08695652173913 35.483870967741936 81.65217391304348 23.87096774193548 83.47826086956522 23.87096774193548C 85.30434782608695 23.87096774193548 86.8695652173913 44.516129032258064 88.69565217391303 44.516129032258064C 90.52173913043477 44.516129032258064 92.08695652173913 18.064516129032256 93.91304347826086 18.064516129032256C 95.7391304347826 18.064516129032256 97.30434782608695 40 99.13043478260869 40C 100.95652173913042 40 102.52173913043478 36.12903225806451 104.34782608695652 36.12903225806451C 106.17391304347825 36.12903225806451 107.73913043478261 34.83870967741935 109.56521739130434 34.83870967741935C 111.39130434782608 34.83870967741935 112.95652173913044 19.999999999999993 114.78260869565217 19.999999999999993C 116.6086956521739 19.999999999999993 118.17391304347825 27.096774193548384 119.99999999999999 27.096774193548384C 119.99999999999999 27.096774193548384 119.99999999999999 27.096774193548384 119.99999999999999 60M 119.99999999999999 27.096774193548384z"
                                                                pathFrom="M -1 60L -1 60L 5.217391304347826 60L 10.434782608695652 60L 15.652173913043477 60L 20.869565217391305 60L 26.08695652173913 60L 31.304347826086953 60L 36.52173913043478 60L 41.73913043478261 60L 46.95652173913043 60L 52.17391304347826 60L 57.391304347826086 60L 62.60869565217391 60L 67.82608695652173 60L 73.04347826086956 60L 78.26086956521739 60L 83.47826086956522 60L 88.69565217391303 60L 93.91304347826086 60L 99.13043478260869 60L 104.34782608695652 60L 109.56521739130434 60L 114.78260869565217 60L 119.99999999999999 60">
                                                            </path>
                                                            <path id="SvgjsPath1442"
                                                                d="M 0 60C 1.826086956521739 60 3.391304347826087 37.41935483870968 5.217391304347826 37.41935483870968C 7.043478260869565 37.41935483870968 8.608695652173914 33.54838709677419 10.434782608695652 33.54838709677419C 12.26086956521739 33.54838709677419 13.826086956521738 37.41935483870968 15.652173913043477 37.41935483870968C 17.478260869565215 37.41935483870968 19.043478260869566 42.58064516129032 20.869565217391305 42.58064516129032C 22.695652173913043 42.58064516129032 24.26086956521739 -7.105427357601002e-15 26.08695652173913 -7.105427357601002e-15C 27.913043478260867 -7.105427357601002e-15 29.478260869565215 25.806451612903224 31.304347826086953 25.806451612903224C 33.130434782608695 25.806451612903224 34.69565217391304 20.645161290322577 36.52173913043478 20.645161290322577C 38.34782608695652 20.645161290322577 39.91304347826087 42.58064516129032 41.73913043478261 42.58064516129032C 43.565217391304344 42.58064516129032 45.130434782608695 25.16129032258064 46.95652173913043 25.16129032258064C 48.78260869565217 25.16129032258064 50.347826086956516 32.258064516129025 52.17391304347826 32.258064516129025C 54 32.258064516129025 55.565217391304344 47.74193548387097 57.391304347826086 47.74193548387097C 59.21739130434782 47.74193548387097 60.78260869565217 30.32258064516129 62.60869565217391 30.32258064516129C 64.43478260869564 30.32258064516129 66 30.96774193548387 67.82608695652173 30.96774193548387C 69.65217391304347 30.96774193548387 71.21739130434783 25.16129032258064 73.04347826086956 25.16129032258064C 74.8695652173913 25.16129032258064 76.43478260869566 35.483870967741936 78.26086956521739 35.483870967741936C 80.08695652173913 35.483870967741936 81.65217391304348 23.87096774193548 83.47826086956522 23.87096774193548C 85.30434782608695 23.87096774193548 86.8695652173913 44.516129032258064 88.69565217391303 44.516129032258064C 90.52173913043477 44.516129032258064 92.08695652173913 18.064516129032256 93.91304347826086 18.064516129032256C 95.7391304347826 18.064516129032256 97.30434782608695 40 99.13043478260869 40C 100.95652173913042 40 102.52173913043478 36.12903225806451 104.34782608695652 36.12903225806451C 106.17391304347825 36.12903225806451 107.73913043478261 34.83870967741935 109.56521739130434 34.83870967741935C 111.39130434782608 34.83870967741935 112.95652173913044 19.999999999999993 114.78260869565217 19.999999999999993C 116.6086956521739 19.999999999999993 118.17391304347825 27.096774193548384 119.99999999999999 27.096774193548384"
                                                                fill="none" fill-opacity="1"
                                                                stroke="rgba(255,255,255,0.3)" stroke-opacity="1"
                                                                stroke-linecap="butt" stroke-width="2"
                                                                stroke-dasharray="0" class="apexcharts-area"
                                                                index="0" clip-path="url(#gridRectMask38glh4n4)"
                                                                pathTo="M 0 60C 1.826086956521739 60 3.391304347826087 37.41935483870968 5.217391304347826 37.41935483870968C 7.043478260869565 37.41935483870968 8.608695652173914 33.54838709677419 10.434782608695652 33.54838709677419C 12.26086956521739 33.54838709677419 13.826086956521738 37.41935483870968 15.652173913043477 37.41935483870968C 17.478260869565215 37.41935483870968 19.043478260869566 42.58064516129032 20.869565217391305 42.58064516129032C 22.695652173913043 42.58064516129032 24.26086956521739 -7.105427357601002e-15 26.08695652173913 -7.105427357601002e-15C 27.913043478260867 -7.105427357601002e-15 29.478260869565215 25.806451612903224 31.304347826086953 25.806451612903224C 33.130434782608695 25.806451612903224 34.69565217391304 20.645161290322577 36.52173913043478 20.645161290322577C 38.34782608695652 20.645161290322577 39.91304347826087 42.58064516129032 41.73913043478261 42.58064516129032C 43.565217391304344 42.58064516129032 45.130434782608695 25.16129032258064 46.95652173913043 25.16129032258064C 48.78260869565217 25.16129032258064 50.347826086956516 32.258064516129025 52.17391304347826 32.258064516129025C 54 32.258064516129025 55.565217391304344 47.74193548387097 57.391304347826086 47.74193548387097C 59.21739130434782 47.74193548387097 60.78260869565217 30.32258064516129 62.60869565217391 30.32258064516129C 64.43478260869564 30.32258064516129 66 30.96774193548387 67.82608695652173 30.96774193548387C 69.65217391304347 30.96774193548387 71.21739130434783 25.16129032258064 73.04347826086956 25.16129032258064C 74.8695652173913 25.16129032258064 76.43478260869566 35.483870967741936 78.26086956521739 35.483870967741936C 80.08695652173913 35.483870967741936 81.65217391304348 23.87096774193548 83.47826086956522 23.87096774193548C 85.30434782608695 23.87096774193548 86.8695652173913 44.516129032258064 88.69565217391303 44.516129032258064C 90.52173913043477 44.516129032258064 92.08695652173913 18.064516129032256 93.91304347826086 18.064516129032256C 95.7391304347826 18.064516129032256 97.30434782608695 40 99.13043478260869 40C 100.95652173913042 40 102.52173913043478 36.12903225806451 104.34782608695652 36.12903225806451C 106.17391304347825 36.12903225806451 107.73913043478261 34.83870967741935 109.56521739130434 34.83870967741935C 111.39130434782608 34.83870967741935 112.95652173913044 19.999999999999993 114.78260869565217 19.999999999999993C 116.6086956521739 19.999999999999993 118.17391304347825 27.096774193548384 119.99999999999999 27.096774193548384"
                                                                pathFrom="M -1 60L -1 60L 5.217391304347826 60L 10.434782608695652 60L 15.652173913043477 60L 20.869565217391305 60L 26.08695652173913 60L 31.304347826086953 60L 36.52173913043478 60L 41.73913043478261 60L 46.95652173913043 60L 52.17391304347826 60L 57.391304347826086 60L 62.60869565217391 60L 67.82608695652173 60L 73.04347826086956 60L 78.26086956521739 60L 83.47826086956522 60L 88.69565217391303 60L 93.91304347826086 60L 99.13043478260869 60L 104.34782608695652 60L 109.56521739130434 60L 114.78260869565217 60L 119.99999999999999 60">
                                                            </path>
                                                            <g id="SvgjsG1435" class="apexcharts-series-markers-wrap">
                                                                <g class="apexcharts-series-markers">
                                                                    <circle id="SvgjsCircle1455" r="0"
                                                                        cx="0" cy="0"
                                                                        class="apexcharts-marker wect0ann5 no-pointer-events"
                                                                        stroke="#ffffff" fill="rgba(255,255,255,0.3)"
                                                                        fill-opacity="1" stroke-width="2"
                                                                        stroke-opacity="0.9" default-marker-size="0">
                                                                    </circle>
                                                                </g>
                                                            </g>
                                                            <g id="SvgjsG1436" class="apexcharts-datalabels">
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <line id="SvgjsLine1450" x1="0" y1="0"
                                                        x2="120" y2="0" stroke="#b6b6b6"
                                                        stroke-dasharray="0" stroke-width="1"
                                                        class="apexcharts-ycrosshairs">
                                                    </line>
                                                    <line id="SvgjsLine1451" x1="0" y1="0"
                                                        x2="120" y2="0" stroke-dasharray="0"
                                                        stroke-width="0" class="apexcharts-ycrosshairs-hidden">
                                                    </line>
                                                    <g id="SvgjsG1452" class="apexcharts-yaxis-annotations">
                                                    </g>
                                                    <g id="SvgjsG1453" class="apexcharts-xaxis-annotations">
                                                    </g>
                                                    <g id="SvgjsG1454" class="apexcharts-point-annotations">
                                                    </g>
                                                </g>
                                                <rect id="SvgjsRect1428" width="0" height="0" x="0"
                                                    y="0" rx="0" ry="0" fill="#fefefe"
                                                    opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0">
                                                </rect>
                                                <g id="SvgjsG1445" class="apexcharts-yaxis" rel="0"
                                                    transform="translate(-21, 0)">
                                                    <g id="SvgjsG1446" class="apexcharts-yaxis-texts-g">
                                                    </g>
                                                </g>
                                            </svg>
                                            <div class="apexcharts-legend"></div>
                                            <div class="apexcharts-tooltip light">
                                                <div class="apexcharts-tooltip-title"
                                                    style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                </div>
                                                <div class="apexcharts-tooltip-series-group">
                                                    <span class="apexcharts-tooltip-marker"
                                                        style="background-color: rgba(255, 255, 255, 0.3);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group">
                                                            <span class="apexcharts-tooltip-text-label"></span><span
                                                                class="apexcharts-tooltip-text-value"></span>
                                                        </div>
                                                        <div class="apexcharts-tooltip-z-group">
                                                            <span class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 129px; height: 61px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden dash1-card border-0 dash4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="text-justify"> <span>Total Tax</span>
                                    <h2 class="mb-2 mt-1 number-font carn2 font-weight-bold">
                                        $1,954
                                    </h2> <span class=""><i class="fe fe-arrow-up-circle"></i>
                                        53%
                                        <span class="ms-1 fs-11">From Last Month</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6 my-auto mx-auto">
                                <div class="mx-auto text-right" style="position: relative;">
                                    <div id="spark4" style="min-height: 60px;">
                                        <div id="apexchartss5zhbuet" class="apexcharts-canvas apexchartss5zhbuet light"
                                            style="width: 120px; height: 60px;"><svg id="SvgjsSvg1459" width="120"
                                                height="60" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"
                                                xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                style="background: transparent;">
                                                <g id="SvgjsG1461" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(0, 0)">
                                                    <defs id="SvgjsDefs1460">
                                                        <clipPath id="gridRectMasks5zhbuet">
                                                            <rect id="SvgjsRect1466" width="122" height="62"
                                                                x="-1" y="-1" rx="0"
                                                                ry="0" fill="#ffffff" opacity="1"
                                                                stroke-width="0" stroke="none" stroke-dasharray="0">
                                                            </rect>
                                                        </clipPath>
                                                        <clipPath id="gridRectMarkerMasks5zhbuet">
                                                            <rect id="SvgjsRect1467" width="122" height="62"
                                                                x="-1" y="-1" rx="0"
                                                                ry="0" fill="#ffffff" opacity="1"
                                                                stroke-width="0" stroke="none" stroke-dasharray="0">
                                                            </rect>
                                                        </clipPath>
                                                        <linearGradient id="SvgjsLinearGradient1473" x1="0"
                                                            y1="0" x2="0" y2="1">
                                                            <stop id="SvgjsStop1474" stop-opacity="0.65"
                                                                stop-color="rgba(153,153,153,0.65)" offset="0"></stop>
                                                            <stop id="SvgjsStop1475" stop-opacity="0.5"
                                                                stop-color="rgba(153,153,153,0.5)" offset="1"></stop>
                                                            <stop id="SvgjsStop1476" stop-opacity="0.5"
                                                                stop-color="rgba(153,153,153,0.5)" offset="1"></stop>
                                                        </linearGradient>
                                                    </defs>
                                                    <line id="SvgjsLine1465" x1="0" y1="0"
                                                        x2="0" y2="60" stroke="#b6b6b6"
                                                        stroke-dasharray="3" class="apexcharts-xcrosshairs"
                                                        x="0" y="0" width="1" height="60"
                                                        fill="#b1b9c4" filter="none" fill-opacity="0.9"
                                                        stroke-width="1">
                                                    </line>
                                                    <g id="SvgjsG1479" class="apexcharts-xaxis"
                                                        transform="translate(0, 0)">
                                                        <g id="SvgjsG1480" class="apexcharts-xaxis-texts-g"
                                                            transform="translate(0, 1.875)">
                                                        </g>
                                                    </g>
                                                    <g id="SvgjsG1483" class="apexcharts-grid">
                                                        <line id="SvgjsLine1485" x1="0" y1="60"
                                                            x2="120" y2="60" stroke="transparent"
                                                            stroke-dasharray="0"></line>
                                                        <line id="SvgjsLine1484" x1="0" y1="1"
                                                            x2="0" y2="60" stroke="transparent"
                                                            stroke-dasharray="0"></line>
                                                    </g>
                                                    <g id="SvgjsG1469"
                                                        class="apexcharts-area-series apexcharts-plot-series">
                                                        <g id="SvgjsG1470" class="apexcharts-series"
                                                            seriesName="TotalxTax" data:longestSeries="true"
                                                            rel="1" data:realIndex="0">
                                                            <path id="SvgjsPath1477"
                                                                d="M 0 60L 0 60C 1.826086956521739 60 3.391304347826087 30.96774193548387 5.217391304347826 30.96774193548387C 7.043478260869565 30.96774193548387 8.608695652173914 25.16129032258064 10.434782608695652 25.16129032258064C 12.26086956521739 25.16129032258064 13.826086956521738 35.483870967741936 15.652173913043477 35.483870967741936C 17.478260869565215 35.483870967741936 19.043478260869566 23.87096774193548 20.869565217391305 23.87096774193548C 22.695652173913043 23.87096774193548 24.26086956521739 44.516129032258064 26.08695652173913 44.516129032258064C 27.913043478260867 44.516129032258064 29.478260869565215 24.516129032258057 31.304347826086953 24.516129032258057C 33.130434782608695 24.516129032258057 34.69565217391304 40 36.52173913043478 40C 38.34782608695652 40 39.91304347826087 36.12903225806451 41.73913043478261 36.12903225806451C 43.565217391304344 36.12903225806451 45.130434782608695 34.83870967741935 46.95652173913043 34.83870967741935C 48.78260869565217 34.83870967741935 50.347826086956516 19.999999999999993 52.17391304347826 19.999999999999993C 54 19.999999999999993 55.565217391304344 27.096774193548384 57.391304347826086 27.096774193548384C 59.21739130434782 27.096774193548384 60.78260869565217 37.41935483870968 62.60869565217391 37.41935483870968C 64.43478260869564 37.41935483870968 66 33.54838709677419 67.82608695652173 33.54838709677419C 69.65217391304347 33.54838709677419 71.21739130434783 29.032258064516125 73.04347826086956 29.032258064516125C 74.8695652173913 29.032258064516125 76.43478260869566 42.58064516129032 78.26086956521739 42.58064516129032C 80.08695652173913 42.58064516129032 81.65217391304348 -7.105427357601002e-15 83.47826086956522 -7.105427357601002e-15C 85.30434782608695 -7.105427357601002e-15 86.8695652173913 25.806451612903224 88.69565217391303 25.806451612903224C 90.52173913043477 25.806451612903224 92.08695652173913 26.4516129032258 93.91304347826086 26.4516129032258C 95.7391304347826 26.4516129032258 97.30434782608695 42.58064516129032 99.13043478260869 42.58064516129032C 100.95652173913042 42.58064516129032 102.52173913043478 25.16129032258064 104.34782608695652 25.16129032258064C 106.17391304347825 25.16129032258064 107.73913043478261 32.258064516129025 109.56521739130434 32.258064516129025C 111.39130434782608 32.258064516129025 112.95652173913044 47.74193548387097 114.78260869565217 47.74193548387097C 116.6086956521739 47.74193548387097 118.17391304347825 30.32258064516129 119.99999999999999 30.32258064516129C 119.99999999999999 30.32258064516129 119.99999999999999 30.32258064516129 119.99999999999999 60M 119.99999999999999 30.32258064516129z"
                                                                fill="url(#SvgjsLinearGradient1473)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="butt" stroke-width="0"
                                                                stroke-dasharray="0" class="apexcharts-area"
                                                                index="0" clip-path="url(#gridRectMasks5zhbuet)"
                                                                pathTo="M 0 60L 0 60C 1.826086956521739 60 3.391304347826087 30.96774193548387 5.217391304347826 30.96774193548387C 7.043478260869565 30.96774193548387 8.608695652173914 25.16129032258064 10.434782608695652 25.16129032258064C 12.26086956521739 25.16129032258064 13.826086956521738 35.483870967741936 15.652173913043477 35.483870967741936C 17.478260869565215 35.483870967741936 19.043478260869566 23.87096774193548 20.869565217391305 23.87096774193548C 22.695652173913043 23.87096774193548 24.26086956521739 44.516129032258064 26.08695652173913 44.516129032258064C 27.913043478260867 44.516129032258064 29.478260869565215 24.516129032258057 31.304347826086953 24.516129032258057C 33.130434782608695 24.516129032258057 34.69565217391304 40 36.52173913043478 40C 38.34782608695652 40 39.91304347826087 36.12903225806451 41.73913043478261 36.12903225806451C 43.565217391304344 36.12903225806451 45.130434782608695 34.83870967741935 46.95652173913043 34.83870967741935C 48.78260869565217 34.83870967741935 50.347826086956516 19.999999999999993 52.17391304347826 19.999999999999993C 54 19.999999999999993 55.565217391304344 27.096774193548384 57.391304347826086 27.096774193548384C 59.21739130434782 27.096774193548384 60.78260869565217 37.41935483870968 62.60869565217391 37.41935483870968C 64.43478260869564 37.41935483870968 66 33.54838709677419 67.82608695652173 33.54838709677419C 69.65217391304347 33.54838709677419 71.21739130434783 29.032258064516125 73.04347826086956 29.032258064516125C 74.8695652173913 29.032258064516125 76.43478260869566 42.58064516129032 78.26086956521739 42.58064516129032C 80.08695652173913 42.58064516129032 81.65217391304348 -7.105427357601002e-15 83.47826086956522 -7.105427357601002e-15C 85.30434782608695 -7.105427357601002e-15 86.8695652173913 25.806451612903224 88.69565217391303 25.806451612903224C 90.52173913043477 25.806451612903224 92.08695652173913 26.4516129032258 93.91304347826086 26.4516129032258C 95.7391304347826 26.4516129032258 97.30434782608695 42.58064516129032 99.13043478260869 42.58064516129032C 100.95652173913042 42.58064516129032 102.52173913043478 25.16129032258064 104.34782608695652 25.16129032258064C 106.17391304347825 25.16129032258064 107.73913043478261 32.258064516129025 109.56521739130434 32.258064516129025C 111.39130434782608 32.258064516129025 112.95652173913044 47.74193548387097 114.78260869565217 47.74193548387097C 116.6086956521739 47.74193548387097 118.17391304347825 30.32258064516129 119.99999999999999 30.32258064516129C 119.99999999999999 30.32258064516129 119.99999999999999 30.32258064516129 119.99999999999999 60M 119.99999999999999 30.32258064516129z"
                                                                pathFrom="M -1 60L -1 60L 5.217391304347826 60L 10.434782608695652 60L 15.652173913043477 60L 20.869565217391305 60L 26.08695652173913 60L 31.304347826086953 60L 36.52173913043478 60L 41.73913043478261 60L 46.95652173913043 60L 52.17391304347826 60L 57.391304347826086 60L 62.60869565217391 60L 67.82608695652173 60L 73.04347826086956 60L 78.26086956521739 60L 83.47826086956522 60L 88.69565217391303 60L 93.91304347826086 60L 99.13043478260869 60L 104.34782608695652 60L 109.56521739130434 60L 114.78260869565217 60L 119.99999999999999 60">
                                                            </path>
                                                            <path id="SvgjsPath1478"
                                                                d="M 0 60C 1.826086956521739 60 3.391304347826087 30.96774193548387 5.217391304347826 30.96774193548387C 7.043478260869565 30.96774193548387 8.608695652173914 25.16129032258064 10.434782608695652 25.16129032258064C 12.26086956521739 25.16129032258064 13.826086956521738 35.483870967741936 15.652173913043477 35.483870967741936C 17.478260869565215 35.483870967741936 19.043478260869566 23.87096774193548 20.869565217391305 23.87096774193548C 22.695652173913043 23.87096774193548 24.26086956521739 44.516129032258064 26.08695652173913 44.516129032258064C 27.913043478260867 44.516129032258064 29.478260869565215 24.516129032258057 31.304347826086953 24.516129032258057C 33.130434782608695 24.516129032258057 34.69565217391304 40 36.52173913043478 40C 38.34782608695652 40 39.91304347826087 36.12903225806451 41.73913043478261 36.12903225806451C 43.565217391304344 36.12903225806451 45.130434782608695 34.83870967741935 46.95652173913043 34.83870967741935C 48.78260869565217 34.83870967741935 50.347826086956516 19.999999999999993 52.17391304347826 19.999999999999993C 54 19.999999999999993 55.565217391304344 27.096774193548384 57.391304347826086 27.096774193548384C 59.21739130434782 27.096774193548384 60.78260869565217 37.41935483870968 62.60869565217391 37.41935483870968C 64.43478260869564 37.41935483870968 66 33.54838709677419 67.82608695652173 33.54838709677419C 69.65217391304347 33.54838709677419 71.21739130434783 29.032258064516125 73.04347826086956 29.032258064516125C 74.8695652173913 29.032258064516125 76.43478260869566 42.58064516129032 78.26086956521739 42.58064516129032C 80.08695652173913 42.58064516129032 81.65217391304348 -7.105427357601002e-15 83.47826086956522 -7.105427357601002e-15C 85.30434782608695 -7.105427357601002e-15 86.8695652173913 25.806451612903224 88.69565217391303 25.806451612903224C 90.52173913043477 25.806451612903224 92.08695652173913 26.4516129032258 93.91304347826086 26.4516129032258C 95.7391304347826 26.4516129032258 97.30434782608695 42.58064516129032 99.13043478260869 42.58064516129032C 100.95652173913042 42.58064516129032 102.52173913043478 25.16129032258064 104.34782608695652 25.16129032258064C 106.17391304347825 25.16129032258064 107.73913043478261 32.258064516129025 109.56521739130434 32.258064516129025C 111.39130434782608 32.258064516129025 112.95652173913044 47.74193548387097 114.78260869565217 47.74193548387097C 116.6086956521739 47.74193548387097 118.17391304347825 30.32258064516129 119.99999999999999 30.32258064516129"
                                                                fill="none" fill-opacity="1"
                                                                stroke="rgba(255,255,255,0.3)" stroke-opacity="1"
                                                                stroke-linecap="butt" stroke-width="2"
                                                                stroke-dasharray="0" class="apexcharts-area"
                                                                index="0" clip-path="url(#gridRectMasks5zhbuet)"
                                                                pathTo="M 0 60C 1.826086956521739 60 3.391304347826087 30.96774193548387 5.217391304347826 30.96774193548387C 7.043478260869565 30.96774193548387 8.608695652173914 25.16129032258064 10.434782608695652 25.16129032258064C 12.26086956521739 25.16129032258064 13.826086956521738 35.483870967741936 15.652173913043477 35.483870967741936C 17.478260869565215 35.483870967741936 19.043478260869566 23.87096774193548 20.869565217391305 23.87096774193548C 22.695652173913043 23.87096774193548 24.26086956521739 44.516129032258064 26.08695652173913 44.516129032258064C 27.913043478260867 44.516129032258064 29.478260869565215 24.516129032258057 31.304347826086953 24.516129032258057C 33.130434782608695 24.516129032258057 34.69565217391304 40 36.52173913043478 40C 38.34782608695652 40 39.91304347826087 36.12903225806451 41.73913043478261 36.12903225806451C 43.565217391304344 36.12903225806451 45.130434782608695 34.83870967741935 46.95652173913043 34.83870967741935C 48.78260869565217 34.83870967741935 50.347826086956516 19.999999999999993 52.17391304347826 19.999999999999993C 54 19.999999999999993 55.565217391304344 27.096774193548384 57.391304347826086 27.096774193548384C 59.21739130434782 27.096774193548384 60.78260869565217 37.41935483870968 62.60869565217391 37.41935483870968C 64.43478260869564 37.41935483870968 66 33.54838709677419 67.82608695652173 33.54838709677419C 69.65217391304347 33.54838709677419 71.21739130434783 29.032258064516125 73.04347826086956 29.032258064516125C 74.8695652173913 29.032258064516125 76.43478260869566 42.58064516129032 78.26086956521739 42.58064516129032C 80.08695652173913 42.58064516129032 81.65217391304348 -7.105427357601002e-15 83.47826086956522 -7.105427357601002e-15C 85.30434782608695 -7.105427357601002e-15 86.8695652173913 25.806451612903224 88.69565217391303 25.806451612903224C 90.52173913043477 25.806451612903224 92.08695652173913 26.4516129032258 93.91304347826086 26.4516129032258C 95.7391304347826 26.4516129032258 97.30434782608695 42.58064516129032 99.13043478260869 42.58064516129032C 100.95652173913042 42.58064516129032 102.52173913043478 25.16129032258064 104.34782608695652 25.16129032258064C 106.17391304347825 25.16129032258064 107.73913043478261 32.258064516129025 109.56521739130434 32.258064516129025C 111.39130434782608 32.258064516129025 112.95652173913044 47.74193548387097 114.78260869565217 47.74193548387097C 116.6086956521739 47.74193548387097 118.17391304347825 30.32258064516129 119.99999999999999 30.32258064516129"
                                                                pathFrom="M -1 60L -1 60L 5.217391304347826 60L 10.434782608695652 60L 15.652173913043477 60L 20.869565217391305 60L 26.08695652173913 60L 31.304347826086953 60L 36.52173913043478 60L 41.73913043478261 60L 46.95652173913043 60L 52.17391304347826 60L 57.391304347826086 60L 62.60869565217391 60L 67.82608695652173 60L 73.04347826086956 60L 78.26086956521739 60L 83.47826086956522 60L 88.69565217391303 60L 93.91304347826086 60L 99.13043478260869 60L 104.34782608695652 60L 109.56521739130434 60L 114.78260869565217 60L 119.99999999999999 60">
                                                            </path>
                                                            <g id="SvgjsG1471" class="apexcharts-series-markers-wrap">
                                                                <g class="apexcharts-series-markers">
                                                                    <circle id="SvgjsCircle1491" r="0"
                                                                        cx="0" cy="0"
                                                                        class="apexcharts-marker wq477dgqc no-pointer-events"
                                                                        stroke="#ffffff" fill="rgba(255,255,255,0.3)"
                                                                        fill-opacity="1" stroke-width="2"
                                                                        stroke-opacity="0.9" default-marker-size="0">
                                                                    </circle>
                                                                </g>
                                                            </g>
                                                            <g id="SvgjsG1472" class="apexcharts-datalabels">
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <line id="SvgjsLine1486" x1="0" y1="0"
                                                        x2="120" y2="0" stroke="#b6b6b6"
                                                        stroke-dasharray="0" stroke-width="1"
                                                        class="apexcharts-ycrosshairs">
                                                    </line>
                                                    <line id="SvgjsLine1487" x1="0" y1="0"
                                                        x2="120" y2="0" stroke-dasharray="0"
                                                        stroke-width="0" class="apexcharts-ycrosshairs-hidden">
                                                    </line>
                                                    <g id="SvgjsG1488" class="apexcharts-yaxis-annotations">
                                                    </g>
                                                    <g id="SvgjsG1489" class="apexcharts-xaxis-annotations">
                                                    </g>
                                                    <g id="SvgjsG1490" class="apexcharts-point-annotations">
                                                    </g>
                                                </g>
                                                <rect id="SvgjsRect1464" width="0" height="0" x="0"
                                                    y="0" rx="0" ry="0" fill="#fefefe"
                                                    opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0">
                                                </rect>
                                                <g id="SvgjsG1481" class="apexcharts-yaxis" rel="0"
                                                    transform="translate(-21, 0)">
                                                    <g id="SvgjsG1482" class="apexcharts-yaxis-texts-g">
                                                    </g>
                                                </g>
                                            </svg>
                                            <div class="apexcharts-legend"></div>
                                            <div class="apexcharts-tooltip light">
                                                <div class="apexcharts-tooltip-title"
                                                    style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                </div>
                                                <div class="apexcharts-tooltip-series-group">
                                                    <span class="apexcharts-tooltip-marker"
                                                        style="background-color: rgba(255, 255, 255, 0.3);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group">
                                                            <span class="apexcharts-tooltip-text-label"></span><span
                                                                class="apexcharts-tooltip-text-value"></span>
                                                        </div>
                                                        <div class="apexcharts-tooltip-z-group">
                                                            <span class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 129px; height: 61px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  --}}
        <!-- End Row-1 -->
        <!-- Row-2 -->
        <!--Row-->
    </div>
@endsection
