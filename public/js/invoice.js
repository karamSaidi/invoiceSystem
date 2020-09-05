

$(document).ready(function () {

    $('#invoice-details').on('keyup blur', '.quantity', function () {
        let row = $(this).closest('tr');
        CalculateRowSubTotal(row);
    });
    $('#invoice-details').on('keyup blur', '.unit_price', function () {
        let row = $(this).closest('tr');
        CalculateRowSubTotal(row);
    });

    $('.discount_type').change(function(){
        calculateVat();
    });
    $('.discount_value').on('keyup blur', function(){
        calculateVat();
    });
    $('.shipping').on('keyup blur', function(){
        calculateVat();
    });

    $(document).on('click', '.btn-add-row', function(e){
        e.preventDefault();

        let trCnt = $('#invoice-details').find('.coloning_row:last').length;
        let increment = trCnt > 0? parseInt($('#invoice-details').find('.coloning_row:last').attr('id')) + 1: 0;
        let add_row = row;

        $('#invoice-details').find('tbody').append(add_row);
        $('#invoice-details').find('.coloning_row:last').attr('id', increment)
        $('#invoice-details').find('.coloning_row:last').find('input.product_name').attr('name', `product_name[${increment}]`)
        $('#invoice-details').find('.coloning_row:last').find('input.unit').attr('name', `unit[${increment}]`)
        $('#invoice-details').find('.coloning_row:last').find('input.quantity').attr('name', `quantity[${increment}]`)
        $('#invoice-details').find('.coloning_row:last').find('input.unit_price').attr('name', `unit_price[${increment}]`)
        $('#invoice-details').find('.coloning_row:last').find('input.row_sub_total').attr('name', `row_sub_total[${increment}]`)

    });
    $(document).on('click', '.btn-delete', function(){
        let rowCount = $('#invoice-details').find('tr.coloning_row').length;
        if(rowCount > 1){
            let delete_row = parseInt($(this).closest('tr').attr('id'));
            $('#' + delete_row).remove();
            SumTotal('.row_sub_total');
        }
    });

});

let CalculateRowSubTotal = function (row){
    let quantity = row.find('.quantity').val() || 0;
    let price = row.find('.unit_price').val() || 0;

    row.find('.row_sub_total').val((quantity * price).toFixed(2));

    SumTotal('.row_sub_total');

}

let SumTotal = function(selector){
    let sum = 0;
    $(selector).each(function(){
        let row_total = $(this).val() || 0;
        sum += parseFloat(row_total);
    });
    $('.sub_total').val(sum.toFixed(2));

    calculateVat();
}

let calculateVat = function(){
    let sub_total  = parseFloat($('.sub_total').val()) || 0;
    let discount_type = $('.discount_type').val();
    let discount_value = parseFloat($('.discount_value').val()) || 0;

    let discountVat = discount_value == 0? 0 : discount_type == 'percentage'? (sub_total * (discount_value / 100)) : discount_value;

    $('.discount_final').val(discountVat.toFixed(2));
    $('.vat_value').val(((sub_total - discountVat) * 0.05).toFixed(2));

    calculateTotalDue();


}

let calculateTotalDue = function(){
    let discount_final  = parseFloat($('.discount_final').val()) || 0;
    let sub_total  = parseFloat($('.sub_total').val()) || 0;
    let vat_value  = parseFloat($('.vat_value').val()) || 0;
    let shipping  = parseFloat($('.shipping').val()) || 0;

    $('.total_due').val((sub_total - discount_final + shipping + vat_value).toFixed(2));

}
