document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');
  if (!form) return;

  // allows to clean errors once user edits (to revalidate)
  ['input', 'change'].forEach(evt => {
    form.addEventListener(evt, e => {
      if (e.target?.setCustomValidity) {
        e.target.setCustomValidity('');
      }
    });
  });

  // validation happens once user clicks submit
  form.addEventListener('submit', (e) => {
    const course = form.elements['course_code'];
    const isbn = form.elements['isbn'];
    const description = form.elements['description'];
    const cover = form.elements['cover_image'];

    if (course.value.trim()) {
      const cc = course.value.trim().toUpperCase();
      if (!/^[A-Z]{3,4}\s?-?\s?\d{3,4}$/.test(cc)) {
        course.setCustomValidity('Use course code format like COMP 3340.');
      }
    }

    if (isbn.value.trim()) {
      const raw = isbn.value.replace(/[\s-]/g, '');
      if (!/^\d{10}(\d{3})?$/.test(raw)) {
        isbn.setCustomValidity('ISBN must be 10 or 13 digits.');
      }
    }

    if (description.value.length > 1000) {
      description.setCustomValidity('Description must be 1000 characters or less.');
    }

    if (cover.files?.[0]) {
      const file = cover.files[0];
      if (file && !file.type.startsWith('image/')) {
        cover.setCustomValidity('Cover image must be an image file.');
      } else if (file.size > 2 * 1024 * 1024) {
        cover.setCustomValidity('Cover image must be 2MB or smaller.');
      }
    }

    if (!form.checkValidity()) {
      e.preventDefault();
      form.reportValidity();
    }
  });
});