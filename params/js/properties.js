if (_.isUndefined(window.vc)) {
    var vc = {atts: {}};
}

jQuery(document).ready(function ($) {
    jQuery('.vcla_slider_bar').slider({
        range: 'min',
        min: 0,
        max: 10000,
        value: jQuery(this).attr('data-val'),
        step: 100,
        slide: function (event, ui) {
            var vcla_box = jQuery(this).closest('.vcla_properties');
            var vcla_key = jQuery(this).attr('data-key');
            jQuery(this).find('.ui-slider-handle').text(ui.value + 'ms');
            jQuery(this).attr('data-val', ui.value);
            jQuery('.vcla_preview_shape').css(vcla_key, ui.value + 'ms');
            vcla_preview(vcla_box, vcla_key, ui.value + 'ms');
            vcla_build_data(vcla_box);
        },
        create: function (event, ui) {
            var vcla_val = jQuery(this).attr('data-val');
            jQuery(this).find('.ui-slider-handle').text(vcla_val + 'ms');
            jQuery(this).slider('value', vcla_val);
        }
    });

    jQuery('.vcla_select_value').on('change', function () {
        var vcla_box = jQuery(this).closest('.vcla_properties');
        var vcla_key = jQuery(this).attr('data-key');
        var vcla_val = jQuery(this).val();
        jQuery(this).attr('data-val', vcla_val);
        vcla_preview(vcla_box, vcla_key, vcla_val);
        vcla_build_data(vcla_box);
    });

    vcla_selected();
    vcla_preview_all();
    vcla_build_data_all();
})

function vcla_preview(vcla_box, vcla_key, vcla_val) {
    vcla_box.find('.vcla_preview_shape').css(vcla_key, vcla_val);
}

function vcla_preview_all() {
    jQuery('.vcla_property').each(function () {
        var vcla_box_id = jQuery(this).attr('data-box');
        var vcla_box = jQuery('#' + vcla_box_id);
        var vcla_key = jQuery(this).attr('data-key');
        var vcla_val = jQuery(this).attr('data-val');
        if (jQuery(this).hasClass('vcla_slider_value')) {
            vcla_preview(vcla_box, vcla_key, vcla_val + 'ms');
        } else {
            vcla_preview(vcla_box, vcla_key, vcla_val);
        }
    });
}

function vcla_build_data(vcla_box) {
    var vcla_data = new Array();
    var vcla_data_str = '';
    vcla_box.find('.vcla_property').each(function () {
        if (jQuery(this).attr('data-val') != '') {
            vcla_data.push(jQuery(this).attr('data-val'));
        } else {
            vcla_data.push('null');
        }
    });
    vcla_data_str = vcla_data.join();
    vcla_box.find('.wpb_vc_param_value').val(vcla_data_str);
}

function vcla_build_data_all() {
    jQuery('.vcla_properties').each(function () {
        vcla_build_data(jQuery(this));
    });
}

function vcla_selected() {
    jQuery('.vcla_select_value').each(function () {
        var vcla_val = jQuery(this).attr('data-val');
        jQuery('select option').filter(function () {
            return jQuery(this).text() == vcla_val;
        }).attr('selected', true);
    });
}