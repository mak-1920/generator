jQuery(function(){
    let isGeneration = false

    $("#slider").ionRangeSlider({
        type: "single",
        min: 0,
        max: 10,
        step: 0.25,
        grid: true,
        max_postfix: '+',
        from_min: true,
        onChange: (e)=>{
            $("#slider-value").val(e.from)
        },
        onFinish: (e) => ajaxGenerate(1)
    })

    $("#slider-value").change((e) => {
        $("#slider").data("ionRangeSlider").update({from: $("#slider-value").val()})
    })

    $("#set-random-seed").click(() => {
        $("#seed").val(Math.round(Math.random() * 10e8))
    })

    $("#generate-form :input:not(#slider)").change(() => ajaxGenerate(1))
    $("#generate-form button").click(() => ajaxGenerate(1))
    ajaxGenerate(1);

    var xhr = null

    function ajaxGenerate(page){
        let form = $("#generate-form")
        if(page == 1) $("#generation-rows").text('')
        if(isGeneration) 
            xhr.abort()
        isGeneration = true

        xhr = $.ajax({
            url: "ajax/generate",
            type: "GET",
            dataType: "json",
            data: {
                "country": form.find('[name=country]').val(),
                "error-count": Math.min(form.find('[name=error-count]').val(), 1000),
                "seed": form.find('[name=seed]').val(),
                "page": page
            },
            beforeSend: function(){
                $("#generation-status").removeClass("d-none")
            },
            success: function(e){
                $.each(e, (i, val) => {
                    let row = "<tr>" +
                        "<td>" + val.num + "</td>" +
                        "<td>" + val.id + "</td>" +
                        "<td class='text-break'>" + val.fcs + "</td>" +
                        "<td class='text-break'>" + val.address + "</td>" +
                        "<td class='text-break'>" + val.phone + "</td>" +
                        "</tr>"
                    $("#generation-rows").append(row);
                })
            },
            complete: function(){
                $("#generation-status").addClass("d-none")
                isGeneration = false
            }
        })
    }

    $(window).scroll(function() 
    {
        if(isGeneration) return
        if($(window).scrollTop() + $(window).height() >= $(document).height() - 10) 
            ajaxGenerate($("#generation-rows tr").length / 10)
    });

    $('#save-csv').click(() => {
        let data = []
        $('#generation-rows tr').each((i, e) => {
            let row = []
            $(e).find('td').each((j, td) => row.push($(td).text()))
            data.push(row)
        })
        console.log(data)
        $.ajax({
            url: 'ajax/createcsv',
            type: 'post',
            dataType: 'json',
            data: {'data' : data},
            success: function(data){
                location = data.fileName
            }
        })
    })
})