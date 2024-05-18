$(document).ready(function () {
    console.log('Document is ready');
    $('#search-button').on('click', function () {
        console.log('Search button clicked');
        var keyword = $('#keyword').val();
        var companyName = $('#company_name').val();
        console.log('Keyword:', keyword);
        console.log('Company Name:', companyName);
        $.ajax({
            url: searchUrl,
            type: 'GET',
            data: {
                keyword: keyword,
                company_name: companyName
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
                            '<input type="hidden" name="_token" value="' + csrfToken + '">' +
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
