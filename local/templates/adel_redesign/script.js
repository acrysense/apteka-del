;(function() {
  var $parent = $('.list-prod');
  var $items = $parent.find('.list-prod__items');
  var $choosen = $parent.find('.list-prod__choosen');
  var $arr = $parent.find('.list-prod__arr');
  $items.children().each(function (index) {
    var $item = $(this);
    console.log(typeof index);
    if (index === 0) {
      $choosen.html($item.html());
      $item.addClass('is-active');
    }
    $item.on('click', function () {
      $item.addClass('is-choosing');
      setTimeout(function () {
        $item
          .removeClass('is-choosing')
          .addClass('is-active')
          .siblings()
            .removeClass('is-active');
        $choosen.html($item.html());
      }, 500)
    });
  });
})();

$(document).ready(function () {

  $('.subscribe .btn').on('click', function (event) {
    OpenWin('WinSubscribe');
    event.preventDefault();
  });

  function forEach(arr, callback) {
    Array.prototype.forEach.call(arr, callback);
  }

  forEach(document.querySelectorAll('[data-toggle="checkbox-toggle"]'), checkbox => {
    // console.log(checkbox.dataset.target);
    const contents = document.querySelectorAll(checkbox.dataset.target);
    // console.log(contents);
    forEach(contents, content => {
      content.style.setProperty('--max-height', content.scrollHeight + 'px');
    });
    checkbox.addEventListener('change', () => {
      forEach(contents, content => {
        content.setAttribute('aria-expanded', checkbox.dataset.swap ? !checkbox.checked : checkbox.checked);
      });
    });
  });

  forEach(document.querySelectorAll('[data-toggle="radiobox-toggle"]'), radiobox => {
    const contents = document.querySelectorAll(radiobox.dataset.target);
    // console.log(document.querySelectorAll(radiobox.name));
    forEach(contents, content => {
      content.style.setProperty('--max-height', content.scrollHeight + 'px');
    });
    radiobox.addEventListener('change', () => {
      forEach(document.querySelectorAll(`[name=${radiobox.name}]`), radio => {
        const contents = document.querySelectorAll(radio.dataset.target);
        forEach(contents, content => {
          content.setAttribute('aria-expanded', radio.checked);
          if (radio.checked) {
            content.setAttribute('data-collapsing', '');
            setTimeout(function () {
              content.removeAttribute('data-collapsing');
            }, 1000)
          }
        });
      });
    });
  });

  if(location.hostname === 'html.xx28.ru') {
    fetch('ajax.pages_list.php')
      .then(
        function(response) {
          if (response.status !== 200) {
            console.log('Looks like there was a problem. Status Code: ' +
              response.status);
            return;
          }

          response.json().then(function(data) {
            if (data.toString().indexOf('<?php') === 0) return;
            const container = document.createElement('div');
            const close = document.createElement('div');
            container.classList.add('upages');
            close.addEventListener('click', () => {
              container.style.display = 'none'
            });
            close.textContent = 'Close';
            container.appendChild(close);
            data.pages.forEach( (page) => {
              const link = document.createElement('a');
              link.textContent = page;
              link.setAttribute('href', page);
              container.appendChild(link)
            });

            document.body.append(container)

          });
        }
      )
      .catch(function(err) {
        console.log('Fetch Error :-S', err);
      });
  }


});

class Move {
  constructor(moreContainer, lessContainer, size, watch = true) {

    this.moreContainer = moreContainer;
    this.lessContainer = lessContainer;
    this.size = size;
    this.watch = watch;
  }

  init() {
    this.move();
    this.actions()
  }

  move() {
    const self = this;
    if (!this.moreContainer) return;
    if (!this.lessContainer) return;

    if(window.innerWidth < this.size) {
      if (!this.moreContainer.children[0]) return;
      let count = this.moreContainer.children.length;
      for (let i = 0; i < count; i++) {
        this.lessContainer.appendChild(self.moreContainer.children[0])
      }
    } else {
      const self = this;
      if (!this.lessContainer.children[0]) return;
      let count = this.lessContainer.children.length;
      for (let i = 0; i < count; i++) {
        this.moreContainer.appendChild(self.lessContainer.children[0])
      }
    }
  }

  actions() {
    const self = this;
    if (!this.watch) return;
    window.addEventListener('resize', () => {
      self.move()
    })
  }
}

new Move(document.querySelector('[data-move="b-similar-get"]'), document.querySelector('[data-move="b-similar-set"]'), 767).init();

basketSubmitWrapper = document.querySelector(".btn-submit-mobile-wrapper");
if (basketSubmitWrapper) {
  var myScrollFunc = function() {
    var y = window.scrollY;
    if (y >= 200) {
      basketSubmitWrapper.style.display = "block"
    } else {
      basketSubmitWrapper.style.display = "none"
    }
  };

  window.addEventListener("scroll", myScrollFunc);
}


const desktopSelect = document.querySelectorAll('.desktop-select__selected')
const desktopSelectButton = document.querySelectorAll('.desktop-select__btn')

if (desktopSelect) {
  desktopSelect.forEach(item => {
    item.addEventListener('click', (event) => {
      event.preventDefault()

      const parent = item.closest('.desktop-select')

      if (parent.classList.contains('is--active')) {
        parent.classList.remove('is--active')
      } else {
        parent.classList.add('is--active')
      }
    })
  })

  if (desktopSelectButton) {
    desktopSelectButton.forEach(item => {
      item.addEventListener('click', (event) => {

        const parent = item.closest('.desktop-select')

        parent.querySelector('.desktop-select__selected').innerHTML = item.innerHTML
        parent.classList.remove('is--active')
      })
    })
  }
}