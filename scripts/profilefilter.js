const posts = document.querySelector('.filter-activity');
const aboutMe = document.querySelector('.filter-about');
const gallery = document.querySelector('.filter-gallery');
const forumPosts = document.querySelector('.filter-posts');

const postsIcon = document.querySelector('.fa-house-user');
const aboutIcon = document.querySelector('.fa-user-circle-identifier');
const galleryIcon = document.querySelector('.fa-photo-video');
const forumPostsIcon = document.querySelector('.fa-folder-open');

const postsSection = document.querySelector('.profile-bottom');
const aboutSection = document.querySelector('.about-me-container');
const gallerySection = document.querySelector('.gallery-container');
const forumPostsSection = document.querySelector('.forum-posts-container');

posts.addEventListener('click', () => {
    postsSection.style.display = 'flex';
    aboutSection.style.display = 'none';
    gallerySection.style.display = 'none';
    forumPostsSection.style.display = 'none';

    postsIcon.style.color = 'var(--headerBlue)';
    aboutIcon.style.color = 'var(--grey)';
    galleryIcon.style.color = 'var(--grey)';
    forumPostsIcon.style.color = 'var(--grey)';
});

aboutMe.addEventListener('click', () => {
    postsSection.style.display = 'none';
    aboutSection.style.display = 'block';
    gallerySection.style.display = 'none';
    forumPostsSection.style.display = 'none';

    postsIcon.style.color = 'var(--grey)';
    aboutIcon.style.color = 'var(--headerBlue)';
    galleryIcon.style.color = 'var(--grey)';
    forumPostsIcon.style.color = 'var(--grey)';
});

gallery.addEventListener('click', () => {
    postsSection.style.display = 'none';
    aboutSection.style.display = 'none';
    gallerySection.style.display = 'block';
    forumPostsSection.style.display = 'none';

    postsIcon.style.color = 'var(--grey)';
    aboutIcon.style.color = 'var(--grey)';
    galleryIcon.style.color = 'var(--headerBlue)';
    forumPostsIcon.style.color = 'var(--grey)';
});

forumPosts.addEventListener('click', () => {
    postsSection.style.display = 'none';
    aboutSection.style.display = 'none';
    gallerySection.style.display = 'none';
    forumPostsSection.style.display = 'block';

    postsIcon.style.color = 'var(--grey)';
    aboutIcon.style.color = 'var(--grey)';
    galleryIcon.style.color = 'var(--grey)';
    forumPostsIcon.style.color = 'var(--headerBlue)';
});