$(function () {
    function fetchProducts(data) {
        $.ajax({
            url: searchUrl,
            type: 'GET',
            data: data,
            success: function (response) {
                var productTable = $('#product-list');
                productTable.empty();
                $.each(response.products, function (index, product) {
                    var companyName = product.company ? product.company.company_name : '';
                    var imgTag = product.img_path ? '<img src="' + assetBaseUrl + product.img_path + '" alt="Image" width="30" height="auto">' : '';
                    var html = '<tr>' +
                                    '<td>' + product.id + '</td>' +
                                    '<td>' + imgTag + '</td>' +
                                    '<td>' + product.product_name + '</td>' +
                                    '<td>¥' + product.price + '</td>' +
                                    '<td>' + product.stock + '</td>' +
                                    '<td>' + companyName + '</td>' +
                                    '<td>' +
                                        '<button class="list__btn--detail" type="button">' +
                                        '<a href="' + detailUrlBase.replace(':id', product.id) + '">詳細</a>' +
                                        '</button>' +
                                    '</td>' +
                                    '<td>' +
                                        '<form action="' + destroyUrlBase.replace(':id', product.id) + '" method="POST" class="delete-form">' +
                                            '<input type="hidden" name="_token" value="' + csrfToken + '">' +
                                            '<input type="hidden" name="_method" value="DELETE">' +
                                            '<button type="submit" class="list__btn--remove">削除</button>' +
                                        '</form>' +
                                    '</td>' +
                                '</tr>';
                    productTable.append(html);
                });
                bindDeleteEvent();
            },
            error: function (xhr, status, error) {
                console.log('AJAX request failed', status, error);
            }
        });
    }
    
    function bindDeleteEvent() {
        $(document).off('click', '.list__btn--remove').on('click', '.list__btn--remove', function (e) {
            e.preventDefault();
            
            var form = $(this).closest('form');
            var url = form.attr('action');
            var row = $(this).closest('tr');

            if (confirm('本当に削除しますか？')) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    success: function (response) {
                        if (response.success) {
                            row.remove();
                        } else {
                            alert('削除に失敗しました: ' + response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('削除に失敗しました: ' + error);
                    }
                });
            }
        });
    }

    fetchProducts({ sort_column: 'id', sort_direction: 'desc' });

    $('#search-button').on('click', function () {
        var data = {
            keyword: $('#keyword').val(),
            company_name: $('#company_name').val(),
            price_min: $('#price_min').val(),
            price_max: $('#price_max').val(),
            stock_min: $('#stock_min').val(),
            stock_max: $('#stock_max').val(),
            sort_column: $('.sort.asc, .sort.desc').data('sort') || 'id',
            sort_direction: $('.sort.asc').length ? 'asc' : 'desc'
        };
    
        fetchProducts(data);
    });
    
    // ソートリンクのクリックイベント
    $('.sort').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        var sortColumn = $this.data('sort');
        var sortDirection = $this.hasClass('asc') ? 'desc' : 'asc';
    
        $('.sort').removeClass('asc').removeClass('desc');
    
        $this.addClass(sortDirection);
    
        var data = {
            keyword: $('#keyword').val(),
            company_name: $('#company_name').val(),
            price_min: $('#price_min').val(),
            price_max: $('#price_max').val(),
            stock_min: $('#stock_min').val(),
            stock_max: $('#stock_max').val(),
            sort_column: sortColumn,
            sort_direction: sortDirection
        };
    
        fetchProducts(data);
    });
    
    bindDeleteEvent();
});

