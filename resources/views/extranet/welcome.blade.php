@extends('extranet.app.app')

@section('title')
    Productos
@endsection

@section('caption')
    <i class="ti-home me-2"></i> Bienvenidos
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xl-2 col-md-6 col-6">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center">
                            <h1 class="fs-50 text-primary"><i class="mdi mdi-wheelchair-accessibility"></i></h1>
                            <h2>4,569</h2>
                            <span class="badge badge-pill badge-primary px-10 mb-10">Patient</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-6 col-6">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center">
                            <h1 class="fs-50 text-warning"><i class="mdi mdi-file-document"></i></h1>
                            <h2>23,009</h2>
                            <span class="badge badge-pill badge-warning px-10 mb-10">Encounters</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-6 col-6">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center">
                            <h1 class="fs-50 text-info"><i class="mdi mdi-calendar-multiple"></i></h1>
                            <h2>56</h2>
                            <span class="badge badge-pill badge-info px-10 mb-10">Appointments</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-6 col-6">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center">
                            <h1 class="fs-50 text-success"><i class="mdi mdi-heart-pulse"></i></h1>
                            <h2>12,100</h2>
                            <span class="badge badge-pill badge-success px-10 mb-10">Lab</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-6 col-6">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center">
                            <h1 class="fs-50 text-danger"><i class="mdi mdi-file-document-box"></i></h1>
                            <h2>14,023</h2>
                            <span class="badge badge-pill badge-danger px-10 mb-10">Prescription</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-6 col-6">
                <div class="box">
                    <div class="box-body">
                        <div class="text-center">
                            <h1 class="fs-50 text-dark"><i class="mdi mdi-redo-variant"></i></h1>
                            <h2>4,567</h2>
                            <span class="badge badge-pill badge-dark px-10 mb-10">Referral</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-script')
@endsection
