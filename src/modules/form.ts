declare let nfbp: any;
export default function ($class: string) {
    jQuery('body').on('submit', $class, function (event: Event) {
        event.preventDefault();
        let formData: object = formDataGet(jQuery(this));
        sendFormToBack(formData);//.then(replySuccess, replyFail);
    });
    function sendFormToBack(data: object) {
        jQuery.ajax({
            url: nfbp.ajaxurl,
            method: 'post',
            data: {
                action: 'nfbpForm',
                nonce: nfbp.nonce,
                formData: data,
                agent: navigator.userAgent
            }
        })
    }
    function formDataGet(form: JQuery): object {
        let unindexedArray: object = form.serializeArray();
        let indexedArray = {};
        jQuery.map(unindexedArray, function (n) {
            indexedArray[n['name']] = n['value'];
        });
        return indexedArray;
    }
}