$(document).ready(function () {
    $('#search-button').on('click', function () {
        var keyword = $('#keyword').val();
        var companyName = $('#company_name').val();
        $.ajax({
            url: searchUrl,
            type: 'GET',
            data: {
                keyword: keyword,
                company_name: companyName
            },
            success: function (response) {
                var productTable = $('#product-list');
                productTable.empty();
                $.each(response.products, function (index, product) {
                    var companyName = product.company ? product.company.company_name : '';
                    var imgTag = product.img_path ? '<img src="' + assetBaseUrl + product.img_path + '" alt="Image" width="30" height="auto">' : '';
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    var html = '<tr>' +
                        '<td>' + product.id + '</td>' +
                        '<td>' + imgTag + '</td>' +
                        '<td>' + product.product_name + '</td>' +
                        '<td>¥' + product.price + '</td>' +
                        '<td>' + product.stock + '</td>' +
                        '<td>' + companyName + '</td>' +
                        '<td>' +
                        '<button class="list__btn--detail">' + 
                        '<a href="' + detailUrlBase.replace(':id', product.id) + '">詳細</a>' + '</button>' +
                        '</td>' +
                        '<td>' +
                        '<form action="' + destroyUrlBase + '/' + product.id + '" method="POST">' +
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
