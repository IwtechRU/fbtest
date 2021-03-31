declare let nfbp: any;
interface ajaxResponse { success: boolean, data: string };
export default function ($class: string) {
    jQuery('body').on('submit', $class, function (event: Event) {
        event.preventDefault();
        let $form: JQuery<HTMLElement> = jQuery(this);
        let formData: object = formDataGet($form);
        sendFormToBack(formData).then((data: ajaxResponse) => {
            gotResponse(data, $form)
        });
    });
    function sendFormToBack(data: object) {
        return new Promise<ajaxResponse>((resolve) => jQuery.ajax({
            url: nfbp.ajaxurl,
            method: 'post',
            data: {
                action: 'nfbpForm',
                nonce: nfbp.nonce,
                formData: data,
                agent: navigator.userAgent
            },
            success: function (data) { resolve(data); }
        }));
    }
    function formDataGet(form: JQuery): object {
        let unindexedArray: object = form.serializeArray();
        let indexedArray = {};
        jQuery.map(unindexedArray, function (n) {
            indexedArray[n['name']] = n['value'];
        });
        return indexedArray;
    }
    function gotResponse(value: ajaxResponse, form: JQuery<HTMLElement>): void {
        form.find('.nfbpmessage').remove();
        if (false === value.success) {
            form.prepend('<div class="nfbpmessage nfbp-error">' + value.data + '</div>')
        } else {
            form.prepend('<div class="nfbpmessage nfbp-success">' + value.data + '</div>')
        }
    }
}