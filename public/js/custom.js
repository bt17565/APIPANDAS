function searchData(inputString, searchContent, api2 = false)
{
    let resultsHtml;
    let appUrl = document.head.querySelector('meta[name="app-url"]').content;
    let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    let requestData = new FormData();
    requestData.append( '_token', csrfToken);
    requestData.append( 'search', inputString);
    if (api2) {
        requestData.append('api_2', 'true')
    }
    $.ajax({
        type: 'POST',
        url: appUrl+'/search-data',
        dataType: 'json',
        contentType: false,
        processData: false,
        beforeSend: function() {},
        complete: function() {},
        data: requestData,
        success: function(response) {
            if (response.success) {
                if (response.matched) {
                    resultsHtml = '<pre><code>'+ JSON.stringify(response.matched,null,'\t') +'</code></pre>';
                }
                $(searchContent).html(resultsHtml);
                $(searchContent).show();
            }
        }
    });
}
$(function(){
    $('.add-more-block').on('click', '.add-more-button', function(){
        let appendHtml = $(this).parents('.add-more-block').find('.item-group .item:first').html();
        
        let htmlContent = "<div class='item'>" + appendHtml + "<div><a href='javascript:void(0)' class='text-danger rounded-0 remove-group-button'> <i class='fa fa-trash-alt'></i> </a></div></div>"
        let uploadBlock = $(this).parents('.add-more-block').find('.item-group');
        $(uploadBlock).append(htmlContent);
        let lastChild = $(uploadBlock).children().last();
        $(lastChild).find('input').val('');
    });

    $('.add-more-block').on('click', '.remove-group-button', function(){
        $(this).parents('.item').remove();
    });
    $.ajaxSetup({
        beforeSend:function(){
            $("#overlay").fadeIn(300);
        },
        complete:function(){
            $("#overlay").fadeOut(300);
        }
    });
    $('.api-1-submit').on('click', function() {
        let form = $(this).parents('.bundler-form');
        let appUrl = document.head.querySelector('meta[name="app-url"]').content;
        let formData = new FormData(form[0]);
        formData.delete('_method');
        let responseBlock = $(form).find('.response-1-block');
        let responseError = $(form).find('.response-1-block .response-error');
        let responseSuccess = $(form).find('.response-1-block .response-success');
        let secondApiBlock = $(form).find('.second-api-block');
        let errorContent;
        $.ajax({
            type: 'POST',
            url: appUrl+'/execute-api-1',
            dataType: 'json',
            contentType: false,
            processData: false,
            data: formData,
            success: function(response) {
                if (!response.success) {
                    $(secondApiBlock).addClass('d-none');
                    if (response.errors) {
                        errorContent = '<ul class="mb-0">';
                        $.each(response.errors, function(index, item){
                            errorContent += '<li>'+ item +'</li>';
                        });
                        errorContent += '</ul>';
                        $(responseSuccess).addClass('d-none');
                        $(responseError).removeClass('d-none');
                        $(responseError).find('.content').html(errorContent);
                        $(responseBlock).removeClass('d-none');
                    }
                    if (response.result) {
                        $(responseSuccess).addClass('d-none');
                        $(responseError).removeClass('d-none');
                        $(responseError).find('.content').html('<pre><code>'+response.result+'</code></pre>');
                        $(responseBlock).removeClass('d-none');
                    }
                } else {
                    $(responseSuccess).removeClass('d-none');
                    $(responseError).addClass('d-none');
                    $(responseSuccess).find('.content').html('<pre><code>'+response.result+'</code></pre>');
                    $(responseBlock).removeClass('d-none');
                    $(secondApiBlock).removeClass('d-none');
                }
            }
        });
    });
    $('.api-2-submit').on('click', function() {
        let form = $(this).parents('.bundler-form');
        let appUrl = document.head.querySelector('meta[name="app-url"]').content;
        let formData = new FormData(form[0]);
        formData.delete('_method');
        let responseBlock = $(form).find('.response-2-block');
        let responseError = $(form).find('.response-2-block .response-error');
        let responseSuccess = $(form).find('.response-2-block .response-success');
        let prepareDataBlock = $(form).find('.prepare-data-block');
        let errorContent;
        $.ajax({
            type: 'POST',
            url: appUrl+'/execute-api-2',
            dataType: 'json',
            contentType: false,
            processData: false,
            data: formData,
            success: function(response) {
                if (!response.success) {
                    $(prepareDataBlock).addClass('d-none');
                    if (response.errors) {
                        errorContent = '<ul class="mb-0">';
                        $.each(response.errors, function(index, item){
                            errorContent += '<li>'+ item +'</li>';
                        });
                        errorContent += '</ul>';
                        $(responseSuccess).addClass('d-none');
                        $(responseError).removeClass('d-none');
                        $(responseError).find('.content').html(errorContent);
                        $(responseBlock).removeClass('d-none');
                    }
                    if (response.result) {
                        $(responseSuccess).addClass('d-none');
                        $(responseError).removeClass('d-none');
                        $(responseError).find('.content').html('<pre><code>'+response.result+'</code></pre>');
                        $(responseBlock).removeClass('d-none');
                    }
                } else {
                    $(responseSuccess).removeClass('d-none');
                    $(responseError).addClass('d-none');
                    $(responseSuccess).find('.content').html('<pre><code>'+response.result+'</code></pre>');
                    $(responseBlock).removeClass('d-none');
                    $(prepareDataBlock).removeClass('d-none');
                }
            }
        });
    });
    $('.response-submit').on('click', function() {
        let form = $(this).parents('.bundler-form');
        let appUrl = document.head.querySelector('meta[name="app-url"]').content;
        let formData = new FormData(form[0]);
        formData.delete('_method');
        let responseBlock = $(form).find('.bundler-response-block');
        let responseError = $(form).find('.bundler-response-block .response-error');
        let responseSuccess = $(form).find('.bundler-response-block .response-success');
        let actionsBlock = $(form).find('.actions-block');
        let errorContent;
        $.ajax({
            type: 'POST',
            url: appUrl+'/execute-current-bundler',
            dataType: 'json',
            contentType: false,
            processData: false,
            data: formData,
            success: function(response) {
                if (!response.success) {
                    $(actionsBlock).addClass('d-none');
                    if (response.errors) {
                        errorContent = '<ul class="mb-0">';
                        $.each(response.errors, function(index, item){
                            errorContent += '<li>'+ item +'</li>';
                        });
                        errorContent += '</ul>';
                        $(responseSuccess).addClass('d-none');
                        $(responseError).removeClass('d-none');
                        $(responseError).find('.content').html(errorContent);
                        $(responseBlock).removeClass('d-none');
                    }
                    if (response.result) {
                        $(responseSuccess).addClass('d-none');
                        $(responseError).removeClass('d-none');
                        $(responseError).find('.content').html('<pre><code>'+response.result+'</code></pre>');
                        $(responseBlock).removeClass('d-none');
                    }
                } else {
                    $(responseSuccess).removeClass('d-none');
                    $(responseError).addClass('d-none');
                    $(responseSuccess).find('.content').html('<pre><code>'+response.result+'</code></pre>');
                    $(responseBlock).removeClass('d-none');
                    $(actionsBlock).removeClass('d-none');
                }
            }
        });
    });
    $('form.bundler-form').on('focus', '.data-2-value', function(e){
        let inputString = $(this).val();
        let searchContent = $(this).parents('.item').find('.search-content');
        if (inputString.startsWith('1.')) {
            searchData(inputString, searchContent);
            $(searchContent).show();
        }
    }).on('focusout', '.data-2-value', function(e){
        $(this).parents('.item').find('.search-content').hide();
    });
    $('form.bundler-form').on('input', '.data-2-value', function() {
        let inputString = $(this).val();
        let searchContent = $(this).parents('.item').find('.search-content');
        if (inputString.startsWith('1.')) {
            searchData(inputString, searchContent);
        } else {
            $(searchContent).html('');
            $(searchContent).hide();
        }
    });

    $('form.bundler-form').on('focus', '.modifications-value', function(e){
        let inputString = $(this).val();
        let searchContent = $(this).parents('.item').find('.search-content');
        if (inputString.startsWith('2.')) {
            searchData(inputString, searchContent, true);
            $(searchContent).show();
        }
    }).on('focusout', '.modifications-value', function(e){
        $(this).parents('.item').find('.search-content').hide();
    });
    $('form.bundler-form').on('input', '.modifications-value', function() {
        let inputString = $(this).val();
        let searchContent = $(this).parents('.item').find('.search-content');
        if (inputString.startsWith('2.')) {
            searchData(inputString, searchContent, true);
        } else {
            $(searchContent).html('');
            $(searchContent).hide();
        }
    });
});
