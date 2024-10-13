const myCarouselElement = document.querySelector('#promotion')

const carousel = new bootstrap.Carousel(myCarouselElement, {
  interval: 2500,
  touch: true,
  pause: "hover"
})


var newproduct = new Glide('.new-product', {
  type: 'slider',
  bound:'true',
  perView: 4,
  focusAt: 0,
  breakpoints: {
    1400: {
      perView: 3
    },
    990: {
      perView: 2
    },
    450: {
      perView: 1
    }
  }
})

var shopCategory = new Glide('.shop-category', {
  type: 'carousel',
  perView: 4,
  focusAt: 0,
  breakpoints: {
    1400: {
      perView: 3
    },
    990: {
      perView: 2
    },
    450: {
      perView: 1
    }
  }
})

shopCategory.mount()

newproduct.mount()