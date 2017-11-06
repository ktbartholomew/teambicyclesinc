const PhotoGallery = function(options) {
  this.photos = [];

  this.state = {
    currentPhoto: 0
  };

  this.handleNextClick = e => {
    e.preventDefault();
    this.state.currentPhoto =
      this.state.currentPhoto + 1 < this.photos.length
        ? this.state.currentPhoto + 1
        : 0;
    this.render();
  };

  this.handlePrevClick = e => {
    e.preventDefault();
    this.state.currentPhoto =
      this.state.currentPhoto !== 0
        ? this.state.currentPhoto - 1
        : this.photos.length - 1;
    this.render();
  };

  this.render = () => {
    var currentPhoto = this.photos[this.state.currentPhoto];

    var contents = document.createElement('div');
    contents.className = 'contents';
    var current = document.createElement('div');
    current.className = 'current image';
    current.style.backgroundImage = `url(${currentPhoto.full})`;

    contents.appendChild(current);

    var controls = document.createElement('div');
    controls.className = 'controls';

    var prevLink = document.createElement('a');
    prevLink.href = '';
    prevLink.className = 'prev';
    prevLink.addEventListener('click', this.handlePrevClick);
    prevLink.innerHTML = '&larr;';
    controls.appendChild(prevLink);

    var nextLink = document.createElement('a');
    nextLink.href = '';
    nextLink.className = 'next';
    nextLink.addEventListener('click', this.handleNextClick);
    nextLink.innerHTML = '&rarr;';
    controls.appendChild(nextLink);

    if (currentPhoto.caption) {
      var caption = document.createElement('div');
      caption.className = 'caption';
      caption.textContent = currentPhoto.caption;
      controls.appendChild(caption);
    }

    options.element.innerHTML = '';
    options.element.appendChild(contents);
    options.element.appendChild(controls);
  };

  options.element.querySelectorAll('img').forEach(image => {
    this.photos.push({
      thumbnail: image.getAttribute('src'),
      full: image.getAttribute('data-src'),
      caption: image.getAttribute('data-caption')
    });
  });

  if (this.photos.length === 0) {
    options.element.parentElement.removeChild(options.element);
    return;
  }
  this.render();
};

document.querySelectorAll('.photo-gallery').forEach(element => {
  PhotoGallery({
    element: element
  });
});
