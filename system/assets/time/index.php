<script src="dist/timepicker.min.js"></script>
<link href="dist/timepicker.min.css" rel="stylesheet" />

<div>
    <input type="text" id="time" placeholder="Time">
</div>
<script>
    var timepicker = new TimePicker('time', {
        lang: 'en',
        theme: 'brown'
    });
    timepicker.on('change', function(evt) {
        var value = (evt.hour || '00') + ':' + (evt.minute || '00');
        evt.element.value = value;
    });
</script>