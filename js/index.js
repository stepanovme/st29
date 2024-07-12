document.getElementById('callMe').addEventListener('click', function() {
    document.getElementById('feedback').scrollIntoView({ behavior: 'smooth' });
});

document.getElementById('callMeBack').addEventListener('click', function() {
    document.getElementById('feedback').scrollIntoView({ behavior: 'smooth' });
});

document.getElementById('callCompany').addEventListener('click', function() {
    document.getElementById('company').scrollIntoView({ behavior: 'smooth' });
});

document.getElementById('callServices').addEventListener('click', function() {
    document.getElementById('services').scrollIntoView({ behavior: 'smooth' });
});

document.getElementById('callWorks').addEventListener('click', function() {
    document.getElementById('works').scrollIntoView({ behavior: 'smooth' });
});

document.getElementById('callContacts').addEventListener('click', function() {
    document.getElementById('contacts').scrollIntoView({ behavior: 'smooth' });
});


document.getElementById('footerCompany').addEventListener('click', function() {
    document.getElementById('company').scrollIntoView({ behavior: 'smooth' });
});

document.getElementById('footerServices').addEventListener('click', function() {
    document.getElementById('services').scrollIntoView({ behavior: 'smooth' });
});

document.getElementById('footerWorks').addEventListener('click', function() {
    document.getElementById('works').scrollIntoView({ behavior: 'smooth' });
});

document.getElementById('footerContacts').addEventListener('click', function() {
    document.getElementById('contacts').scrollIntoView({ behavior: 'smooth' });
});



document.addEventListener('DOMContentLoaded', function () {
    const title = document.querySelector('.service .title');
    const cards = document.querySelectorAll('.service .card');

    const titleWorks = document.querySelector('.our-works .title');
    const reasons = document.querySelectorAll('.our-works .reasons');
    const work = document.querySelectorAll('.our-works .work');

    const options = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, options);

    if (title) observer.observe(title);

    cards.forEach((card, index) => {
        observer.observe(card);
        card.style.animationDelay = `${index * 0.1}s`;
    });

    if (titleWorks) observer.observe(titleWorks);

    reasons.forEach((reason, index) => {
        observer.observe(reason);
        reason.style.animationDelay = `${index * 0.1}s`;
    });

    work.forEach((work, index) => {
        observer.observe(work);
        work.style.animationDelay = `${index * 0.1}s`;
    });

});