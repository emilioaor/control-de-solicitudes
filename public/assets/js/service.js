var currentValue = [];
var newValue = [];
var deleted = [];
var addValue = [];
var pend = 0;

$(window).on("load",function(){
    getCurrentValue();
});

function startEdition(id) {
    $("#view" + id).css("display","none");
    $("#edit" + id).css("display","block");
    $("#buttonEdit" + id).css("display","none");
    $("#buttonDelete" + id).css("display","none");
    $("#buttonSave" + id).css("display","inline-block");
    $("#buttonReturn" + id).css("display","inline-block");
}

function returnEdition(id) {
    $("#inputService" + id).val(currentValue[id]);
    $("#view" + id).html(currentValue[id]);
    init(id)
}

function init(id) {
    $("#view" + id).css("display","block");
    $("#edit" + id).css("display","none");
    $("#buttonEdit" + id).css("display","inline-block");
    $("#buttonDelete" + id).css("display","inline-block");
    $("#buttonSave" + id).css("display","none");
    $("#buttonReturn" + id).css("display","none");
}

function initAll() {
    newValue = [];
    deleted = [];
    pend = 0;
    for (var id in currentValue) {
        init(id);
        $("#inputService" + id).val(currentValue[id]);
        $("#view" + id).html(currentValue[id]);
        $("#spaceService" + id).css("display","block");
    }
    $("#labelPend").html("Cambios pendientes: " + pend);
    $("#alertSuccess").css("display","none");
    $("#alertFail").css("display","none");
}

function deleteService(id) {
    $("#spaceService" + id).css("display","none");
    deleted[id] = id;
    if (typeof(newValue[id]) == 'undefined') {
        pend++;
    }
    $("#labelPend").html("Cambios pendientes: " + pend);
}

function addService() {
    if ($("#newService").val() != '') {
        var data = {
            addValue: $("#newService").val()
        }

        $.ajax({
            url : '/admin/add/REST/services',
            type : 'get',
            data : data,
            success : function (data) {
                if (data.ok) {
                    render(data.id);
                    $("#newService").val("");
                } else {

                }
            },
            error : function(error){

            }
        });
    }
}

function render(id) {
    $("#spaceAll").append($("#model").html());
    $("#spaceAll #spaceService").attr("id","spaceService" + id);
    $("#spaceAll #view").html($("#newService").val());
    $("#spaceAll #view").attr("id","view" + id);
    $("#spaceAll #edit").attr("id","edit" + id);
    $("#spaceAll #inputService").val($("#newService").val());
    $("#spaceAll #inputService").attr("id","inputService" + id);

    $("#spaceAll #buttonEdit").attr("onclick","startEdition(" + id + ")");
    $("#spaceAll #buttonDelete").attr("onclick","deleteService(" + id + ")");
    $("#spaceAll #buttonSave").attr("onclick","saveChanges(" + id + ")");
    $("#spaceAll #buttonReturn").attr("onclick","returnEdition(" + id + ")");

    $("#spaceAll #buttonEdit").attr("id","buttonEdit" + id);
    $("#spaceAll #buttonDelete").attr("id","buttonDelete" + id);
    $("#spaceAll #buttonSave").attr("id","buttonSave" + id);
    $("#spaceAll #buttonReturn").attr("id","buttonReturn" + id);
}

function saveChanges(id){
    $("#view" + id).html($("#inputService" + id).val());
    if (typeof(newValue[id]) == 'undefined') {
        pend++;
    }
    newValue[id] = $("#inputService" + id).val();
    init(id);
    $("#labelPend").html("Cambios pendientes: " + pend);
}

function updateServices() {
    var data = {
        editValue : newValue,
        delValue : deleted,
    }

    $.ajax({
        url : '/admin/update/REST/services',
        type : 'get',
        data : data,
        beforeSend: function() {
            $("#alertSuccess").css("display","none");
            $("#alertFail").css("display","none");
        },
        success : function (data) {
            pend = 0;
            if (data.ok) {
                $("#alertSuccess").css("display","inline-block");
            } else {
                $("#alertFail").css("display","inline-block");
                $("#alertFail").attr("title",data.message);
            }
        },
        error : function(error){
            $("#alertFail").css("display","inline-block");
        },
        complete: function() {
            $("#labelPend").html("Cambios pendientes: " + pend);
        }
    });
}

function getCurrentValue() {
    $.ajax({
        url : '/admin/get/REST/currentValue',
        type : 'get',
        success : function (data) {
            currentValue = [];
            for (var current in data) {
                currentValue[data[current].id] = data[current].name;
            }
        },
        error : function(error){
            console.log(error);
        },
    });
}
