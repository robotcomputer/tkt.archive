const tagMapping = {
    'tag1': 'Transport',
    'tag2': 'General Admission',
    'tag3': 'Service',
    'tag4': 'Misc',
  };

  // Get params from URL
  const urlParams = new URLSearchParams(window.location.search);
  const image = urlParams.get('image');
  const tags = urlParams.get('tags');
  const name = urlParams.get('name');
  const description = urlParams.get('description');
  const source = urlParams.get('source');

  // Set image source
  document.getElementById('image').src = image;

  // Get the tags container
  const tagsContainer = document.getElementById('tags');

  // Display tags
  if (tags) {
    const tagList = tags.split(',');
    const mappedTags = tagList.map(tag => tagMapping[tag] || tag);
    tagsContainer.innerHTML = `<strong>Tags:</strong> ${mappedTags.join(', ')}<br>`;
  }

document.getElementById('name').textContent = name || 'Unknown';
document.getElementById('description').textContent = description || '—';
document.getElementById('source').textContent = source || '—';

  // Display name, description, and source
  if (name) {
    tagsContainer.innerHTML += `<strong>Submitted by:</strong> ${name}<br>`;
  }

  if (description) {
    tagsContainer.innerHTML += `<strong>Description:</strong> ${description}<br>`;
  }

  if (source) {
    tagsContainer.innerHTML += `<strong>Source:</strong> ${source}<br>`;
  }