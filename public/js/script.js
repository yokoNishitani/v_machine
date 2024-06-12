$(function () {
    $('#search-button').on('click', function () {
        console.log('Search button clicked');
        var keyword = $('#keyword').val();
        var companyName = $('#company_name').val();
        var priceMin = $('#price_min').val();
        var priceMax = $('#price_max').val();
        var stockMin = $('#stock_min').val();
        var stockMax = $('#stock_max').val();
        $.ajax({
            url: searchUrl,
            type: 'GET',
            data: {
                keyword: keyword,
                company_name: companyName,
                price_min: priceMin,
                price_max: priceMax,
                stock_min: stockMin,
                stock_max: stockMax
            },
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
                                        '<form action="' + destroyUrlBase.replace(':id', product.id) + '" method="POST">' +
                                            '<input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">' +
                                            '<input type="hidden" name="_method" value="DELETE">' +
                                            '<button type="submit" class="list__btn--remove" onclick="return confirm(\'本当に削除しますか？\')">削除</button>' +
                                        '</form>' +
                                    '</td>' +
                                '</tr>';
                    productTable.append(html);
                });
            },
            error: function (xhr, status, error) {
                console.log('AJAX request failed', status, error);
            }
        });
    });
    $(document).on('submit', '.delete-form', function (e) {
        e.preventDefault();
        
        var form = $(this);
        var url = form.attr('action');
        var row = form.closest('tr');
        
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

    $('.sort').on('click', function (e) {
        e.preventDefault();

        var sortColumn = $(this).data('sort');
        var sortDirection = $(this).hasClass('asc') ? 'desc' : 'asc';

        // 現在のソート方向を切り替え
        $(this).toggleClass('asc', sortDirection === 'asc');
        $(this).toggleClass('desc', sortDirection === 'desc');

        $.ajax({
            url: sortUrl,
            type: 'GET',
            data: {
                sort_column: sortColumn,
                sort_direction: sortDirection
            },
            success: function (response) {
                var products = response.products;
                var productRows = '';

                products.forEach(function (product) {
                    productRows += '<tr>' +
                        '<td>' + product.id + '</td>' +
                        '<td>' + (product.img_path ? '<img src="' + assetBaseUrl + product.img_path + '" alt="Image" width="30" height="auto">' : '') + '</td>' +
                        '<td>' + product.product_name + '</td>' +
                        '<td>¥' + product.price + '</td>' +
                        '<td>' + product.stock + '</td>' +
                        '<td>' + product.company.company_name + '</td>' +
                        '<td>' +
                        '<button class="list__btn--detail" type="button">' +
                        '<a href="' + detailUrlBase.replace(':id', product.id) + '">詳細</a>' +
                        '</button>' +
                        '</td>' +
                        '<td>' +
                        '<form action="' + destroyUrlBase.replace(':id', product.id) + '" method="POST" class="delete-form">' +
                        '<input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">' +
                        '<input type="hidden" name="_method" value="DELETE">' +
                        '<button type="submit" class="list__btn--remove">削除</button>' +
                        '</form>' +
                        '</td>' +
                        '</tr>';
                });

                $('#product-list').html(productRows);
            },
            error: function (xhr, status, error) {
                console.error('Sort failed', status, error);
            }
        });
    });
});
