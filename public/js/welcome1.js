$(function() {
    $('div.products-count a').click(function(event) {
        event.preventDefault();
        $('a.products-actual-count').text($(this).text());
        getProducts($(this).text());
    });

    $('a#filter-button').click(function(event) {
        event.preventDefault();
        console.log($('a#actual-count').text());
        getProducts($('a#actual-count').text());
    });



    function getProducts(paginate){
        const form = $('form.sidebar-filter').serialize()
        /* console.log(decodeURI(form));*/
        $.ajax({
            method: "GET",
            url: "/",
            data: form + "&" + $.param({paginate: paginate})

        })
            .done(function (response) {
                /*alert('Sukces done 3');*/
                /*console.log(response.data);*/
                $('div#products-wrapper').empty();


                $.each(response.data, function (index, product) {
                    /*console.log(product);*/
                    const html = '<div class="col-6 col-md-6 col-lg-4 mb-3">' +
                        '                                <div class="card h-100 border-0">' +
                        '                                    <div class="card-img-top">' +
                        '                                            <img src="' + getImage(product) +'" class="img-fluid mx-auto d-block" alt="Zdjęcie produktu">' +
                        '                                    </div>' +
                        '                                    <div class="card-body text-center">' +
                        '                                        <h4 class="card-title">' +
                        '                                          <i> '+ product.name +'</i> '+
                        '                                        </h4>' +
                        '                                        <h5 class="card-price small">' +
                        '                                            <i>PLN '+ product.price +'</i>' +
                        '                                        </h5>' +
                        '                                    </div>' +
                        '                                </div>' +
                        '                            </div>';
                    $('div#products-wrapper').append(html);
                })



            })
            .fail(function (data) {
                alert('Errorek fail');
            });
    }

    function getImage(product) {
        if (!!product.image_path) {
            return storagePath + product.image_path;
        }
        return defaultImage;
    }
});
