// code for the search bar
(function($){
  $('#userFilter').focus().keyup(function(event){
    let input = $(this);
    let val = input.val();
    if (val == '') {
      $('#filter div').show('');
      $('#filter span').removeClass('highlighted');
      return true;
    }

    let regexp = '\\b(.*)';
    for (let i in val) {
      regexp += '('+val[i]+')(.*)';
    } 
    regexp += '\\b';

    $('#filter div').show();
    $('#filter').find('h2>span').each(function(){
      let span = $(this);
      let results = span.text().match(new RegExp(regexp,'i'));
      if (results) {
        let string = '';
        for (let i in results) {
          if (i > 0) {
            if (i%2 == 0) {
              string +='<span class="highlighted">' + results[i]+'</span>';
            } else {
              string += results[i];
            }
          }
        }
        span.empty().append(string);
      } else {
        span.parent().parent().hide();
      }
    })
  })
})(jQuery);

// code for filters
window.onload = () => {
  const FiltersForm = document.querySelector('#filters');

  document.querySelectorAll('#filters input').forEach(input => {
    input.addEventListener('change', () => {
      const Form = new FormData(FiltersForm);

      const Params = new URLSearchParams();

      Form.forEach((value, key) => {
        Params.append(key, value);
      });

      const Url = new URL(window.location.href);

      fetch(Url.pathname + '?' + Params.toString() + '&ajax=1', {
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      }).then(response => 
        response.json()
      ).then(data => {
        const content = document.querySelector('.content');
        content.innerHTML = data.content;
        history.pushState({}, null, Url.pathname + '?' + Params.toString());
      }).catch(e => alert(e));
    })
  })
}