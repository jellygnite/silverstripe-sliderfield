jQuery.entwine('ss', ($) => {
  $('input.slider').entwine({
    getMin() {
      return this.data('min');
    },
    getMax() {
      return this.data('max');
    },
    getStep() {
      return this.data('step');
    },
    getUnit() {
      return this.data('unit');
    },
    getOrientation() {
      return this.data('orientation');
    },
    limitValue() {
      let val = parseFloat(this.val());
      if (isNaN(val)) val = 0;
      val = Math.max(this.getMin(), Math.min(this.getMax(), val));
      this.val(val);
      return val;
    },
    onmatch() {
      const _that = this;
      const val = _that.limitValue();
        // setup slider controller
	  
      $('<div class="slide-controller"></div>')
        .insertAfter(_that)
        .slider({
          orientation: _that.getOrientation(),
          range: 'min',
          value: val,
          min: _that.getMin(),
          max: _that.getMax(),
          step: _that.getStep(),
          unit: _that.getUnit(),
          slide: (event, ui) => {
            _that.val(ui.value);
			$(_that).trigger("change");
        }
      });
      var $labelwrap = $(this).wrap('<div class="slide-field-wrap"></div>');
	  var strunitlabel = this.getUnit() ? this.getUnit() : '';
	  $unitlabel = $('<span class="slide-unit-label">'+strunitlabel+'</span>').insertAfter(this);
		
    },
    onchange() {
      this
        .siblings('.slide-controller')
        .slider('value', this.limitValue());
    }
  });
});