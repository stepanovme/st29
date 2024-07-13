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
    const btnWorks = document.querySelector('.our-works .content .viewBtn');

    const titleCompany = document.querySelector('.about-company .title');
    const descrCompany = document.querySelector('.about-company .descr');
    const imgCompany = document.querySelector('.about-company img');

    const titleRevies = document.querySelector('.reviews .title');
    const review = document.querySelectorAll('.reviews .review');
    const buttonReview = document.querySelectorAll('.reviews button');

    const titleSendReview = document.querySelector('.send-review p.title');
    const descrSendReview = document.querySelector('.send-review .descr');
    const inputSendReview = document.querySelectorAll('.send-review input');
    const textareaSendReview = document.querySelectorAll('.send-review textarea');
    const btnSendReview = document.querySelector('.send-review button');

    const formFeedback = document.querySelector('.feedback form');

    const titleContacts = document.querySelector('.contacts .title');
    const phoneContacts = document.querySelector('.contacts .phone');
    const emailContacts = document.querySelector('.contacts .email');
    const adressContacts = document.querySelector('.contacts .address');
    const mapsContacts = document.querySelector('.contacts .maps');

    const nameFooter = document.querySelector('footer p');
    const titleFooter = document.querySelectorAll('footer p.title');
    const contactsFooter = document.querySelectorAll('footer .contacts p');
    const navsFooter = document.querySelectorAll('footer .nav a');

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

    if (btnWorks) observer.observe(btnWorks);

    if (titleCompany) observer.observe(titleCompany);

    if (descrCompany) observer.observe(descrCompany);

    if (imgCompany) observer.observe(imgCompany);

    if (titleRevies) observer.observe(titleRevies);

    review.forEach((review, index) => {
        observer.observe(review);
        review.style.animationDelay = `${index * 0.1}s`;
    });

    buttonReview.forEach((buttonReview, index) => {
        observer.observe(buttonReview);
        buttonReview.style.animationDelay = `${index * 0.1}s`;
    });

    if (titleSendReview) observer.observe(titleSendReview);
    if (descrSendReview) observer.observe(descrSendReview);

    inputSendReview.forEach((inputSendReview, index) => {
        observer.observe(inputSendReview);
        inputSendReview.style.animationDelay = `${index * 0.1}s`;
    });

    textareaSendReview.forEach((textareaSendReview, index) => {
        observer.observe(textareaSendReview);
        textareaSendReview.style.animationDelay = `${index * 0.1}s`;
    });

    if (btnSendReview) observer.observe(btnSendReview);

    if (formFeedback) observer.observe(formFeedback);

    if (titleContacts) observer.observe(titleContacts);
    if (phoneContacts) observer.observe(phoneContacts);
    if (emailContacts) observer.observe(emailContacts);
    if (adressContacts) observer.observe(adressContacts);
    if (mapsContacts) observer.observe(mapsContacts);

    if (nameFooter) observer.observe(nameFooter);

    titleFooter.forEach((titleFooter, index) => {
        observer.observe(titleFooter);
        titleFooter.style.animationDelay = `${index * 0.1}s`;
    });

    contactsFooter.forEach((contactsFooter, index) => {
        observer.observe(contactsFooter);
        contactsFooter.style.animationDelay = `${index * 0.1}s`;
    });

    navsFooter.forEach((navsFooter, index) => {
        observer.observe(navsFooter);
        navsFooter.style.animationDelay = `${index * 0.1}s`;
    });

});