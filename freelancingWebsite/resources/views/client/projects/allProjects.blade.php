@extends('layouts.app')
@section('title','myProjects')
@section('style')
<style type="text/css">
    body{margin-top:20px;
    background-color:#eee;
    }
    .project-list-table {
        border-collapse: separate;
        border-spacing: 0 12px
    }

    .project-list-table tr {
        background-color: #fff
    }

    .table-nowrap td, .table-nowrap th {
        white-space: nowrap;
    }
    .table-borderless>:not(caption)>*>* {
        border-bottom-width: 0;
    }
    .table>:not(caption)>*>* {
        padding: 0.75rem 0.75rem;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

    .avatar-sm {
        height: 2rem;
        width: 2rem;
    }
    .rounded-circle {
        border-radius: 50%!important;
    }
    .me-2 {
        margin-right: 0.5rem!important;
    }
    img, svg {
        vertical-align: middle;
    }

    a {
        color: #3b76e1;
        text-decoration: none;
    }

    .badge-soft-danger {
        color: #f56e6e !important;
        background-color: rgba(245,110,110,.1);
    }
    .badge-soft-success {
        color: #63ad6f !important;
        background-color: rgba(99,173,111,.1);
    }

    .badge-soft-primary {
        color: #3b76e1 !important;
        background-color: rgba(59,118,225,.1);
    }

    .badge-soft-info {
        color: #57c9eb !important;
        background-color: rgba(87,201,235,.1);
    }

    .avatar-title {
        align-items: center;
        background-color: #3b76e1;
        color: #fff;
        display: flex;
        font-weight: 500;
        height: 100%;
        justify-content: center;
        width: 100%;
    }
    .bg-soft-primary {
        background-color: rgba(59,118,225,.25)!important;
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
@endsection
@section('content')
<div class="container mt-5">
    <div class="main-body">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('client.profile')}}">profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">myProjects</li>

          </ol>
        </nav>
        <!-- /Breadcrumb -->
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="mb-3">
                <h5 class="card-title">My Projects <span class="text-muted fw-normal ms-2">({{$projects->total()}})</span></h5>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">

                <div>
                    <a href="{{route('client.project.create')}}" data-bs-toggle="modal" data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i> Add New</a>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <div class="table-responsive">
                    <table class="table project-list-table table-nowrap align-middle table-borderless">
                        <thead>
                            <tr>

                                <th scope="col">#</th>
                                <th scope="col">PROJECT TITLE</th>
                                <th scope="col">Category</th>
                                <th scope="col">NUMBER BIDS </th>
                                <th scope="col">AVIRAGE BID</th>
                                <th scope="col">STATUS</th>
                                <th scope="col" style="width: 200px;">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <th scope="row" class="ps-4">
                                    {{ $projects->firstItem() + $loop->index }}
                                </th>
                                <td><a href="{{route('client.project.show',[$project->id,$project->title])}}" class="text-body">{{$project->title}}</a></td>
                                <td><span class="badge badge-soft-success mb-0">{{$project->proposals()->count()}}</span></td>

                                <td>{{$project->category->name}}</td>
                                <td>${{($project->proposals()->count()!=0)?$project->proposals()->sum('budget')/$project->proposals()->count():0}}</td>
                                <td>{{$project->status}}</td>
                                <td>
                                    <ul class="list-inline mb-0">
                                        @if($project->status=='ongoing')


                                        <li class="list-inline-item">
                                            <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"> Cancle</i>
                                            </a>
                                            <a href="{{route('contractPage',$project->proposal->id)}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="btn btn-warning"><i class="fa fa-envelope" aria-hidden="true" style="color:#fff"> contact freelancer </i>
                                            </a>
                                        </li>

                                        @endif
                                    </ul>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-0 align-items-center pb-4">

        {{$projects->links()}}
    </div>
</div>
</div>

@endsection

@section('scripts')
@endsection
