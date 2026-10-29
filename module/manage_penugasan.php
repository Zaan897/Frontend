<?php
session_start();
?>

<style>
    #overlay {
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background: rgba(0,0,0,0.6);
        z-index: 999;
    }

    #popup {
        display: none;
        position: fixed;
        width: 700px;
        max-width: 90%;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background: white;
        border-radius: 8px;
        box-shadow: 0px 0px 15px rgba(0,0,0,.3);
        z-index: 1000;
    }
</style>

<ul class="breadcrumb">
    <li><a href="#">Master File</a></li>
    <li class="active">Manage Penugasan</li>
</ul>

<div class="page-title">
    <h2>
        <span class="fa fa-tasks"></span>
        Manage Penugasan
    </h2>
</div>

<div class="page-content-wrap">

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-heading">

                    <h3 class="panel-title">
                        Data Penugasan
                    </h3>

                    <ul class="panel-controls">

                        <button
                            class="btn btn-info"
                            id="btnTambah">

                            <i class="fa fa-plus"></i>
                            Tambah Data

                        </button>

                    </ul>

                </div>

                <div class="panel-body">

                    <table
                        id="table_penugasan"
                        class="table table-bordered table-striped datatable">

                        <thead>

                            <tr>

                                <th width="5%">No</th>

                                <th width="12%">Action</th>

                                <th>Nama User</th>

                                <th>Tanggal</th>

                                <th>Jam Mulai</th>

                                <th>Jam Selesai</th>

                                <th>Status</th>

                                <th>Keterangan</th>

                            </tr>

                        </thead>

                        <tbody></tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<div id="overlay"></div>

<div id="popup">

    <div class="panel panel-default">

        <div class="panel-heading">

            <h3 class="panel-title" id="judul_popup">
                Tambah Penugasan
            </h3>

        </div>

        <div class="panel-body">

            <input
                type="hidden"
                id="id_penugasan">

            <div class="form-group">

                <label>User</label>

                <select
                    id="id_user"
                    class="form-control">

                    <option value="">
                        -- Pilih User --
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label>Tanggal</label>

                <input
                    type="date"
                    id="tanggal"
                    class="form-control">

            </div>

            <div class="form-group">

                <label>Jam Mulai</label>

                <input
                    type="time"
                    id="jam_mulai"
                    class="form-control">

            </div>

            <div class="form-group">

                <label>Jam Selesai</label>

                <input
                    type="time"
                    id="jam_selesai"
                    class="form-control">

            </div>

            <div
                class="form-group"
                id="group_status"
                style="display:none;">

                <label>Status</label>

                <select
                    id="status_penugasan"
                    class="form-control">

                    <option value="Aktif">
                        Aktif
                    </option>

                    <option value="Selesai">
                        Selesai
                    </option>

                    <option value="Dibatalkan">
                        Dibatalkan
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label>Keterangan</label>

                <textarea
                    id="keterangan"
                    class="form-control"
                    rows="4"></textarea>

            </div>

        </div>

        <div class="panel-footer">

            <button
                class="btn btn-default"
                id="btnBatal">

                Batal

            </button>

            <button
                class="btn btn-success pull-right"
                id="btnSimpan">

                Simpan

            </button>

        </div>

    </div>

</div>

<script>

// const BASE_URL = "http://192.168.8.118:8000/api";

// const TOKEN = localStorage.getItem("token");

// const LEVEL = localStorage.getItem("level");

// let table;

// let mode = "tambah";

// let id_edit = "";

// if (!TOKEN) {

//     alert("Silahkan login terlebih dahulu.");

//     window.location.href = "login.php";

// }

if (LEVEL != "Admin") {

    alert("Halaman ini hanya dapat diakses Admin.");

    window.location.href = "dashboard.php";

}

const header = {

    Authorization: "Bearer " + TOKEN

};

$(document).ready(function () {

    loadUser();

    loadTable();

});

function resetForm() {

    $("#id_penugasan").val("");

    $("#id_user").val("");

    $("#tanggal").val("");

    $("#jam_mulai").val("");

    $("#jam_selesai").val("");

    $("#status_penugasan").val("Aktif");

    $("#keterangan").val("");

}

function openPopupTambah() {

    mode = "tambah";

    id_edit = "";

    resetForm();

    $("#judul_popup").text("Tambah Penugasan");

    $("#group_status").hide();

    $("#overlay").fadeIn(200);

    $("#popup").fadeIn(200);

}

function closePopup() {

    $("#popup").fadeOut(200);

    $("#overlay").fadeOut(200);

}

$("#btnTambah").click(function () {

    openPopupTambah();

});

$("#btnBatal").click(function () {

    closePopup();

});

$("#overlay").click(function () {

    closePopup();

});

function loadUser() {

    $("#id_user").html(
        '<option value="">-- Pilih User --</option>'
    );

    $.ajax({

        url: BASE_URL + "/penugasan/user",

        type: "GET",

        headers: header,

        success: function (response) {

            if (response.status) {

                $.each(response.data, function (i, item) {

                    $("#id_user").append(

                        "<option value='" + item.id + "'>" +

                        item.name +

                        "</option>"

                    );

                });

            }

        },

        error: function () {

            Swal.fire(

                "Error",

                "Gagal mengambil data user",

                "error"

            );

        }

    });

}

function loadTable() {

    if ($.fn.DataTable.isDataTable("#table_penugasan")) {

        $("#table_penugasan").DataTable().destroy();

    }

    table = $("#table_penugasan").DataTable({

        ajax: {

            url: BASE_URL + "/penugasan/index",

            type: "GET",

            headers: header,

            dataSrc: "data"

        },

        columns: [

            {
                data: "no"
            },

            {
                data: null,

                render: function (data) {

                    return `

                        <button
                            class="btn btn-warning btn-xs btn-edit"
                            data-id="${data.id}">

                            Edit

                        </button>

                        <button
                            class="btn btn-danger btn-xs btn-delete"
                            data-id="${data.id}">

                            Hapus

                        </button>

                    `;

                }

            },

            {
                data: "user.name"
            },

            {
                data: "tanggal"
            },

            {
                data: "jam_mulai"
            },

            {
                data: "jam_selesai"
            },

            {
                data: "status_penugasan"
            },

            {
                data: "keterangan"
            }

        ]

    });

}