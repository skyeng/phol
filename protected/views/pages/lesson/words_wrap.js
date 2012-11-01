// Plugin to jQuery wrapping words and sentences

(function( $, window, document, undefined ) {
  var WordWrap = {
    init: function( options, elem ) {
      var self = this;

      var container = $( elem );

      options = (typeof options === 'function') ?
        {onClick: options} :
        options

      self.options = $.extend( {}, $.fn.wordWrap.options, options );

      var tags = {
        sentence: self.options.sentence_tag,
        word    : self.options.word_tag
      };

      var html = container.html();
      var level = 0;
      var htmlNew = '';
      var sentenceStarted = false;
      for (var i=0; i<=html.length-1; i++) {
        var chr = html[i];

        // don't catch empty chars
        if (chr.match(/[\r\n\s\t]/i)) {
            htmlNew += chr;
            continue;
        }

        // omit all tags
        if (chr == '<') {  
            var index = html.indexOf('>', i+1); // find end of tag
            if(html[i+1] == '/')
              level--;
            else if(html[index-1] != '/')
              level++;
            if(level < 0){//поднялся выше тега, в котором предложение открылось
              sentenceStarted = false;
              htmlNew += '</'+tags.sentence+'>';
            }
            htmlNew += html.substr(i, index-i+1);
            i = index;
            continue;
        }

        // open sentence
        if (sentenceStarted == false) {
            level = 0;
            sentenceStarted = true;
            htmlNew += '<'+tags.sentence+'>';
        }

        // close sentence
        if (sentenceStarted) {
            var chrNext = html[i+1];
            if ((chr.match(/[\?\.!]/i) && !chrNext.match(/[\?\.!]/i) && chrNext!='<')) {
                sentenceStarted = false;
                htmlNew += chr + '</'+tags.sentence+'>';
                continue;
            }
        }

        if (chr.match(/\W/)) {
            htmlNew += chr;
        }
        else {
            htmlNew += '<'+tags.word+'>' + chr + '</'+tags.word+'>';
        }
      }

      // close sentence if needed
      if (sentenceStarted) {
          htmlNew = htmlNew.replace(/(.)[\r\n\s\t]+$/gi, '$1' + '</'+tags.sentence+'>');
      }

      // remove empty words tags
      var tagWordEmpty = '<'+tags.word+'></'+tags.word+'>';
      while (htmlNew.indexOf(tagWordEmpty)>=0) htmlNew=htmlNew.replace(tagWordEmpty, '');
       
      // remove double words tags
      var tagWordDouble = '</'+tags.word+'><'+tags.word+'>';
      while (htmlNew.indexOf(tagWordDouble)>=0) htmlNew=htmlNew.replace(tagWordDouble, '');

      container.html(htmlNew);

      // add hover_class to sentence and word on hover
      container.on('mouseenter', 'sen, w', function(){
        $(this).addClass(self.options.hover_class);
      })

      container.on('mouseleave', 'sen, w', function(){
        $(this).removeClass(self.options.hover_class);
      })

      container.on('click', 'w', function(){
        $this = $(this);
        self.options.onClick({
          elem: $this,
          word: $this.text(),
          sentence: $this.parent().text().replace(/\s+/g,' ')
        });
      });
    },


  }

  $.fn.wordWrap = function( options ) {
    return this.each(function() {
      var wordwrap = Object.create( WordWrap );
      
      WordWrap.init( options, this );

      $.data( this, 'wordWrap', wordwrap );
    });
  };

  $.fn.wordWrap.options = {
    sentence_tag: 'sen',
    word_tag    : 'w',
    hover_class : 'hover',
    onClick: function(){}
  };

})( jQuery, window, document );
