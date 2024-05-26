$(document).ready(function () {
    console.log('Document is ready');
    $('#search-button').on('click', function () {
        console.log('Search button clicked');
        var keyword = $('#keyword').val();
        var companyName = $('#company_name').val();
        var priceMin = $('#price_min').val();
        var priceMax = $('#price_max').val();
        var stockMin = $('#stock_min').val();
        var stockMax = $('#stock_max').val();
        console.log('Keyword:', keyword);
        console.log('Company Name:', companyName);
        console.log('Price Min:', priceMin);
        console.log('Price Max:', priceMax);
        console.log('Stock Min:', stockMin);
        console.log('Stock Max:', stockMax);
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
                console.log('AJAX request successful', response);
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
});
