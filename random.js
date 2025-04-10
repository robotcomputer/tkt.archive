
//random ticket//

document.addEventListener('DOMContentLoaded', () => {
    const randomIcons = document.querySelectorAll('.random-trigger');
    const images = [
      { path: 'images/Image_14.png', tags: 'tag1' },
      { path: 'images/Image_16.png', tags: 'tag2' },
      { path: 'images/Image_12.png', tags: 'tag1' },
      { path: 'images/Image_18.png', tags: 'tag4' },
      { path: 'images/Screenshot_20250324_161023_Google_Play_services.png', tags: 'tag1' },
      { path: 'images/Visual_Language-ITP-Fall-2018.png', tags: 'tag1' },
      { path: 'images/concertrandom.png', tags: 'tag2' },
      { path: 'images/4289cd87945201.5e7b80299a3b0.png', tags: 'tag2' },
      { path: 'images/pinkticket.png', tags: 'tag3' },
      { path: 'images/lejfbeqfj.png', tags: 'tag3' },
      { path: 'images/kjvkajd.png', tags: 'tag2' }
    ];
  
    randomIcons.forEach(icon => {
      icon.addEventListener('click', () => {
        const randomIndex = Math.floor(Math.random() * images.length);
        const { path, tags } = images[randomIndex];
        window.location.href = `image_page.html?image=${encodeURIComponent(path)}&tags=${tags}&print=true`;
      });
    });
  });
  