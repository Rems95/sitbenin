! function($) {
    "use strict";
    $(document).ready(function() {
        $("[data-auto-open].dhvc-form-popup").each(function() {
            var e, a, t = $(this),
                r = t.attr("id"),
                o = t.data("open-delay"),
                i = t.data("auto-close"),
                n = t.data("close-delay"),
                d = t.data("one-time");
            clearTimeout(e), clearTimeout(a), e = setTimeout(function() {
                clearTimeout(a), d ? $.cookie(r) || ($(".dhvc-form-pop-overlay").show(), $("body").addClass("dhvc-form-opening"), t.show(), $.cookie(r, 1, {
                    expires: 3600,
                    path: "/"
                })) : ($.cookie(r, 0, {
                    expires: -1
                }), $(".dhvc-form-pop-overlay").show(), t.show())
            }, o), i && (a = setTimeout(function() {
                clearTimeout(e), $(".dhvc-form-pop-overlay").hide(), $("body").addClass("dhvc-form-opening"), t.hide()
            }, n))
        }), $(document).on("click", '[data-toggle="dhvcformpopup"],[rel="dhvcformpopup"]', function(e) {
            e.stopPropagation(), e.preventDefault();
            var a, t = $(this),
                r = $(t.attr("data-target") || (a = t.attr("href")) && a.replace(/.*(?=#[^\s]+$)/, ""));
            t.is("a") && e.preventDefault(), $(".dhvc-form-pop-overlay").show(), $("body").addClass("dhvc-form-opening"), r.show(), r.off("click").on("click", function(e) {
                e.target === e.currentTarget && ($(".dhvc-form-pop-overlay").hide(), $("body").removeClass("dhvc-form-opening"), r.hide())
            })
        }), $(document).on("click", ".dhvc-form-popup-close", function(e) {
            $(".dhvc-form-pop-overlay").hide(), $("body").removeClass("dhvc-form-opening"), $(this).closest(".dhvc-form-popup").hide()
        }), $(".dhvc-form-slider-control").each(function() {
            var e = $(this);
            e.slider({
                min: e.data("min"),
                max: e.data("max"),
                step: e.data("step"),
                range: "range" == e.data("type") || "min",
                slide: function(a, t) {
                    "range" == e.data("type") ? (e.closest(".dhvc-form-group").find(".dhvc-form-slider-value-from").text(t.values[0]), e.closest(".dhvc-form-group").find(".dhvc-form-slider-value-to").text(t.values[1]), e.closest(".dhvc-form-group").find('input[type="hidden"]').val(t.values[0] + "-" + t.values[1]).trigger("change")) : (e.closest(".dhvc-form-group").find(".dhvc-form-slider-value").text(t.value), e.closest(".dhvc-form-group").find('input[type="hidden"]').val(t.value).trigger("change"))
                }
            }), "range" == e.data("type") ? e.slider("values", [0, e.data("minmax")]) : e.slider("value", e.data("value"))
        });
        var basename = function(e, a) {
                var t = e,
                    r = t.charAt(t.length - 1);
                return "/" !== r && "\\" !== r || (t = t.slice(0, -1)), t = t.replace(/^.*[\/\\]/g, ""), "string" == typeof a && t.substr(t.length - a.length) == a && (t = t.substr(0, t.length - a.length)), t
            },
            operators = {
                ">": function(e, a) {
                    return e > a
                },
                "=": function(e, a) {
                    return e == a
                },
                "<": function(e, a) {
                    return e < a
                }
            },
            get_field_val = function(e, a) {
                var t = $(a),
                    r = $(e);
                return r.is(":checkbox") ? $.map(t.find("[data-conditional-name=" + r.data("conditional-name") + "].dhvc-form-value:checked"), function(e) {
                    return $(e).val()
                }) : r.is(":radio") ? t.find("[data-conditional-name=" + r.data("conditional-name") + "].dhvc-form-value:checked").val() : r.val()
            },
            conditional_hook = function(e) {
                var a, t, r = $(e.currentTarget),
                    o = r.closest("form"),
                    i = dhvcformL10n.container_class,
                    n = r.closest(i),
                    d = r.data("conditional"),
                    c = [],
                    s = null;
                return a = get_field_val(r, o), t = r.is(":checkbox") ? !o.find("[data-conditional-name=" + r.data("conditional-name") + "].dhvc-form-value:checked").length : r.is(":radio") ? !o.find("[data-conditional-name=" + r.data("conditional-name") + "].dhvc-form-value:checked").val() : !a.length, t ? ($.each(d, function(e, a) {
                    var t = a.element.split(",");
                    $.each(t, function(e, a) {
                        o.find(".dhvc-form-control-" + a).closest(i).addClass("dhvc-form-hidden")
                    })
                }), $.each(d, function(e, a) {
                    var t = a.element.split(",");
                    "is_empty" == a.type && ("hide" == a.action ? $.each(t, function(e, a) {
                        var t = o.find(".dhvc-form-control-" + a);
                        t.closest(i).addClass("dhvc-form-hidden"), t.trigger("change")
                    }) : $.each(t, function(e, a) {
                        var t = o.find(".dhvc-form-control-" + a);
                        t.closest(i).removeClass("dhvc-form-hidden"), t.trigger("change")
                    }))
                })) : ($.isNumeric(a) && (a = parseInt(a)), $.each(d, function(e, t) {
                    t.value == a ? s = t : c.push(t)
                }), null != s && (c.push(s), d = c), $.each(d, function(e, t) {
                    var r = t.element.split(",");
                    n.hasClass("dhvc-form-hidden") ? $.each(r, function(e, a) {
                        o.find(".dhvc-form-control-" + a).closest(i).addClass("dhvc-form-hidden")
                    }) : "not_empty" == t.type ? "hide" == t.action ? $.each(r, function(e, a) {
                        var t = o.find(".dhvc-form-control-" + a);
                        t.closest(i).addClass("dhvc-form-hidden"), t.trigger("change")
                    }) : $.each(r, function(e, a) {
                        var t = o.find(".dhvc-form-control-" + a);
                        t.closest(i).removeClass("dhvc-form-hidden"), t.trigger("change")
                    }) : "is_empty" == t.type ? "hide" == t.action ? $.each(r, function(e, a) {
                        var t = o.find(".dhvc-form-control-" + a);
                        t.closest(i).removeClass("dhvc-form-hidden"), t.trigger("change")
                    }) : $.each(r, function(e, a) {
                        var t = o.find(".dhvc-form-control-" + a);
                        t.closest(i).addClass("dhvc-form-hidden"), t.trigger("change")
                    }) : $.isArray(a) ? $.inArray(t.value, a) > -1 ? "hide" == t.action ? $.each(r, function(e, a) {
                        var t = o.find(".dhvc-form-control-" + a);
                        t.closest(i).addClass("dhvc-form-hidden"), t.trigger("change")
                    }) : $.each(r, function(e, a) {
                        var t = o.find(".dhvc-form-control-" + a);
                        t.closest(i).removeClass("dhvc-form-hidden"), t.trigger("change")
                    }) : "hide" == t.action ? $.each(r, function(e, a) {
                        var t = o.find(".dhvc-form-control-" + a);
                        t.closest(i).removeClass("dhvc-form-hidden"), t.trigger("change")
                    }) : $.each(r, function(e, a) {
                        var t = o.find(".dhvc-form-control-" + a);
                        t.closest(i).addClass("dhvc-form-hidden"), t.trigger("change")
                    }) : ($.isNumeric(a) && (a = parseInt(a)), $.isNumeric(t.value) && "0" != t.value && (t.value = parseInt(t.value)), "not_empty" != t.type && "is_empty" != t.type && operators[t.type](a, t.value) ? "hide" == t.action ? $.each(r, function(e, a) {
                        var t = o.find(".dhvc-form-control-" + a);
                        t.closest(i).addClass("dhvc-form-hidden"), t.trigger("change")
                    }) : $.each(r, function(e, a) {
                        var t = o.find(".dhvc-form-control-" + a);
                        t.closest(i).removeClass("dhvc-form-hidden"), t.trigger("change")
                    }) : "hide" == t.action ? $.each(r, function(e, a) {
                        var t = o.find(".dhvc-form-control-" + a);
                        t.closest(i).removeClass("dhvc-form-hidden"), t.trigger("change")
                    }) : $.each(r, function(e, a) {
                        var t = o.find(".dhvc-form-control-" + a);
                        t.closest(i).addClass("dhvc-form-hidden"), t.trigger("change")
                    }))
                })), !0
            },
            update_hidden_fields = function(e) {
                var a = $(e),
                    t = [];
                a.find(".dhvc-form-value").filter(function() {
                    var e = $(this).attr("data-name") || this.name;
                    return !($.inArray(e, t) >= 0 || $(this).is(":visible")) && (t.push(e), !0)
                }), a.find("#_dhvc_form_hidden_fields").val(JSON.stringify(t))
            },
            conditional_form = function(e, a) {
                var t = $(e).find(".dhvc-form-conditional"),
                    a = a || !1;
                $.each(t, function() {
                    var e = $(this).find("[data-conditional].dhvc-form-value");
                    !1 === a && $(e).bind("keyup change", function(e) {
                        conditional_hook(e)
                    }), $.each(e, function() {
                        var e = $(this);
                        conditional_hook({
                            currentTarget: e
                        })
                    })
                })
            },
            form_math = function(form) {
                var $form = $(form),
                    maths = [];
                $(".dhvc-form-math", $form).each(function() {
                    var match, match_value = 0,
                        $this = $(this),
                        pattern = /\[(.*?)\]/g,
                        operators = $this.data("value-math");
                    if (!$.isNumeric(operators)) {
                        if ("" === operators.replace(/[^.*()\-+\/]+/g, "")) {
                            var $el = $("[data-field-name=" + operators + "]", $form),
                                field_value = parseFloat(get_field_val($el, $form));
                            field_value = isNaN(field_value) ? 0 : field_value, match_value = field_value
                        } else {
                            var fields = operators.split(/[*()\-+\/]/);
                            $.each(fields, function(e, a) {
                                var t = $("[data-field-name=" + a + "]", $form);
                                if (t.length) {
                                    var r = parseFloat(get_field_val(t, $form));
                                    r = isNaN(r) ? 0 : r;
                                    var o = new RegExp(a, "g");
                                    operators = operators.replace(o, r)
                                }
                            });
                            try {
                                match_value = parseFloat(eval(operators).toFixed(2))
                            } catch (e) {
                                match_value = 0
                            }
                        }
                        $this.text(match_value), $(document.body).trigger("dhvc_form_math_change", [$form])
                    }
                })
            };
        $(document.body).on("dhvc_form_math_change", function(e, a) {
            var t = 0,
                r = $(a);
            $(".paypal-item-price-value", r).each(function() {
                t += parseFloat($(this).text())
            }), $(".paypal-total-value").text(t)
        }), $().xdsoftDatetimepicker && "function" == typeof $.xdsoftDatetimepicker.setLocale && $.xdsoftDatetimepicker.setLocale(dhvcformL10n.datetimepicker_lang);
        var form_submit_loading = function(e, a) {
            a = a || !1;
            var t = $(e),
                r = t.find(".dhvc-form-submit"),
                o = t.find(".dhvc-form-submit-label"),
                i = t.find(".dhvc-form-submit-spinner");
            a ? (r.removeAttr("disabled"), o.removeClass("dhvc-form-submit-label-hidden"), i.hide()) : (r.attr("disabled", "disabled"), o.addClass("dhvc-form-submit-label-hidden"), i.show())
        };
        $(".dhvc-form-datepicker").length && $(".dhvc-form-datepicker").each(function() {
            var e = $(this);
            e.xdsoftDatetimepicker({
                format: dhvcformL10n.date_format,
                formatDate: dhvcformL10n.date_format,
                timepicker: !1,
                scrollMonth: !1,
                dayOfWeekStart: parseInt(dhvcformL10n.dayofweekstart),
                scrollTime: !1,
                minDate: e.data("min-date"),
                maxDate: e.data("max-date"),
                yearStart: e.data("year-start"),
                yearEnd: e.data("year-end"),
                scrollInput: !1
            })
        }), $(".dhvc-form-timepicker").length && $(".dhvc-form-timepicker").each(function() {
            var e = $(this);
            e.xdsoftDatetimepicker({
                format: dhvcformL10n.time_format,
                formatTime: dhvcformL10n.time_format,
                datepicker: !1,
                scrollMonth: !1,
                scrollTime: !0,
                scrollInput: !1,
                dayOfWeekStart: parseInt(dhvcformL10n.dayofweekstart),
                minTime: e.data("min-time"),
                maxTime: e.data("max-time"),
                minDate: e.data("min-date"),
                maxDate: e.data("max-date"),
                yearStart: e.data("year-start"),
                yearEnd: e.data("year-end"),
                step: parseInt(dhvcformL10n.time_picker_step)
            })
        }), $(".dhvc-form-datetimepicker").length && $(".dhvc-form-datetimepicker").each(function() {
            var e = $(this);
            e.xdsoftDatetimepicker({
                format: dhvcformL10n.date_format + " " + dhvcformL10n.time_format,
                datepicker: !0,
                scrollMonth: !1,
                scrollTime: !0,
                scrollInput: !1,
                minTime: e.data("min-time"),
                maxTime: e.data("max-time"),
                step: parseInt(dhvcformL10n.time_picker_step)
            })
        });
        var initForm = function(form) {
            var $form = $(form),
                submiting = !1,
                submitBtn = $form.find(".dhvc-form-submit");
            $(".dhvc-form-file", $form).find("input[type=file]").on("change", function() {
                var e = $(this).val();
                $(this).closest("label").find(".dhvc-form-control").prop("value", basename(e))
            }), $(".dhvc-form-file", $form).each(function() {
                $(this).find('input[type="text"]').css({
                    "padding-right": $(this).find(".dhvc-form-file-button").outerWidth(!0) + "px"
                }), $(this).find('input[type="text"]').on("click", function() {
                    $(this).closest("label").trigger("click")
                })
            }), $().tooltip && $(".dhvc-form-rate .dhvc-form-rate-star", $form).tooltip({
                html: !0,
                container: $("body")
            });
            var clearResponse = function(e) {
                    var a = $(e);
                    a.removeClass("invalid spam sent failed"), $("[aria-invalid]", a).attr("aria-invalid", "false"), $(".dhvc-form-error", a).remove(), $(".dhvc-form-control", a).removeClass("dhvc-form-not-valid"), $(".dhvc-form-message", a.parent()).hide().empty().removeAttr("role").removeClass("dhvc-form-validation-errors dhvc-form-spam dhvc-form-errors dhvc-form-success")
                },
                refill = function(e, a) {
                    var t = $(e);
                    a.captcha && function(e, a) {
                        $.each(a, function(a, t) {
                            e.find(':input[name="' + a + '"]').val(""), e.find("img.dhvc-form-captcha-img-" + a).attr("src", t);
                            var r = /([0-9]+)\.(png|gif|jpeg)$/.exec(t);
                            e.find('input:hidden[name="_dhvc_form_captcha_challenge_' + a + '"]').attr("value", r[1])
                        })
                    }(t, a.captcha)
                },
                notValidTip = function(e, a) {
                    if ("" != a) {
                        var t = $(e);
                        $(".dhvc-form-error", t).remove();
                        var r = $('<span role="alert" class="dhvc-form-error"></span>');
                        r.text(a), t.is(":radio") || t.is(":checkbox") ? r.appendTo(t.parent().parent()) : "recaptcha" == t.attr("data-dhvcform-recaptcha") ? r.appendTo(t.closest(".dhvc-form-group")) : r.appendTo(t.parent().parent())
                    }
                },
                form_step_click_init = function(e) {
                    var a = $(e);
                    $(".dhvc-form-step", a).on("click", function(e) {
                        var t = $(this);
                        if (e.stopPropagation(), e.preventDefault(), t.hasClass("actived")) {
                            $(".dhvc-form-message.dhvc-form-success", a.parent()).hide().empty().removeAttr("role").removeClass("dhvc-form-validation-errors dhvc-form-spam dhvc-form-errors dhvc-form-success");
                            var r = $(this).data("step-index");
                            $(".dhvc-form-steps", a).find(".active").removeClass("active"), t.removeClass("actived").addClass("active"), $(".dhvc-form-step-content", a).removeClass("active"), $(".dhvc-form-step-content-" + r, a).addClass("active"), $("#_dhvc_form_current_step", a).val(r)
                        }
                    })
                };
            form_step_click_init($form);
            var ajaxSuccess = function(data, status, xhr, $form) {
                var $message = $(".dhvc-form-message", $form.parent());
                switch (data.status) {
                    case "validation_failed":
                        var firstInvalidFields = null;
                        $.each(data.invalid_fields, function(e, a) {
                            firstInvalidFields || (firstInvalidFields = $(a.into)), notValidTip($(a.into), a.reason), $(".dhvc-form-control", $(a.into).closest(".dhvc-form-group")).addClass("dhvc-form-not-valid"), $("[aria-invalid]", $(a.into)).attr("aria-invalid", "true")
                        });
                        try {
                            firstInvalidFields.focus().trigger("focusin")
                        } catch (e) {}
                        $message.addClass("dhvc-form-validation-errors"), $form.addClass("invalid"), $(document.body).trigger("dhvc_form_invalid", [$form, data]);
                        break;
                    case "success":
                        if ($form.find("#_dhvc_form_steps").length) {
                            var step_final = '<div class="dhvc-form-steps-final"></div>';
                            $form.find(".dhvc-form-step-contents").append($(step_final))
                        }
                        data.onOk && $.each(data.onOk, function(i, n) {
                            eval(n)
                        }), $message.addClass("dhvc-form-success"), $(document.body).trigger("dhvc_form_success", [$form, data]);
                        break;
                    case "spam":
                        $message.addClass("dhvc-form-spam"), $(document.body).trigger("dhvc_form_spam", [$form, data]);
                        break;
                    case "upload_failed":
                        $message.addClass("dhvc-form-errors"), $(document.body).trigger("dhvc_form_upload_failed", [$form, data]);
                        break;
                    case "form_not_exist":
                        $message.addClass("dhvc-form-errors"), $(document.body).trigger("dhvc_form_not_exist", [$form, data]);
                        break;
                    case "action_failed":
                        $message.addClass("dhvc-form-errors"), $(document.body).trigger("dhvc_form_action_failed", [$form, data]);
                        break;
                    case "call_action_failed":
                        $message.addClass("dhvc-form-errors"), $(document.body).trigger("dhvc_form_call_action_failed", [$form, data]);
                        break;
                    case "next_step":
                        var $current_step_input = $("#_dhvc_form_current_step", $form),
                            $current_step = parseInt($current_step_input.val()),
                            $all_steps = parseInt($("#_dhvc_form_steps", $form).val()),
                            $next_step = $current_step + 1;
                        $next_step <= $all_steps && ($(".dhvc-form-steps", $form).find(".active").removeClass("active"), $(".dhvc-form-step-" + $current_step, $form).addClass("actived"), $(".dhvc-form-step-" + $next_step, $form).addClass("active"), $(".dhvc-form-step-content", $form).removeClass("active"), $(".dhvc-form-step-content-" + $next_step, $form).addClass("active"), $("#_dhvc_form_current_step", $form).val($next_step))
                }
                refill($form, data), $(document.body).trigger("dhvc_form_submit", [$form, data]), "success" === data.status && ($form.each(function() {
                    this.reset()
                }), conditional_form($form, !0), data.redirect && (window.location = data.redirect)), data.redirect || "" == data.message || ($message.html(data.message), $message.attr("role", "alert"), $form.find(".dhvc-form-steps-final").length ? ($(".dhvc-form-step-content").each(function() {
                    $(this).remove()
                }), $form.find(".dhvc-form-steps-final").html($message.clone()), $message.remove()) : $message.slideDown("fast"))
            };
            $form.submit(function(e) {
                if (!submiting && "function" == typeof window.FormData) {
                    submiting = !0, clearResponse($form), update_hidden_fields($form);
                    var a = new FormData($form.get(0));
                    $.ajax({
                        type: "POST",
                        url: dhvcformL10n.ajax_url,
                        data: a,
                        dataType: "json",
                        processData: !1,
                        contentType: !1,
                        beforeSend: function() {
                            $(document.body).trigger("dhvc_form_before_submit", [$form, submitBtn]), form_submit_loading($form, !1)
                        }
                    }).done(function(e, a, t) {
                        $(document.body).trigger("dhvc_form_after_submit", [$(form), submitBtn, e]), ajaxSuccess(e, a, t, $form), submiting = !1, form_submit_loading($form, !0)
                    }).fail(function(e, a, t) {
                        submiting = !1, form_submit_loading($form, !0)
                    }), e.preventDefault()
                }
            })
        };
        $("form.dhvcform").each(function() {
            var e = $(this);
            form_math(e), $(".dhvc-form-value", e).bind("keyup change", function(e) {
                form_math($(this).closest("form"))
            }), conditional_form(e), e.hasClass("dhvcform-action-default") && initForm(e)
        })
    })
}(window.jQuery);