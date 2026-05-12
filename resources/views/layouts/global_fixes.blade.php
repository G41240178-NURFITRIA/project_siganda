<style>
/* PREMIUM UI FIXES */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}
::-webkit-scrollbar-track {
    background: transparent; 
}
::-webkit-scrollbar-thumb {
    background: #cbd5e1; 
    border-radius: 10px;
}
::-webkit-scrollbar-thumb:hover {
    background: #94a3b8; 
}

body, .dashboard {
    background: #F0F4FA !important; /* Latar belakang abu-abu kebiruan yang sangat soft untuk menonjolkan card putih */
    min-height: 100vh;
    margin: 0;
}

.sidebar {
    position: fixed !important;
    top: 0;
    left: 0;
    width: 260px !important;
    height: 100vh !important;
    z-index: 9999 !important;
    overflow-y: auto !important;
    /* Gradasi sidebar yang dipertahankan tapi diberi border dan shadow agar terpisah tegas dari background utama */
    background: linear-gradient(180deg, #a8c7ff 0%, #cfe3ff 40%, #e6f1ff 75%, #ffffff 100%) !important;
    box-shadow: 4px 0 24px rgba(10, 61, 145, 0.06) !important;
    border-right: 1px solid rgba(255, 255, 255, 0.6) !important;
}

.main {
    margin-left: 260px !important;
    width: calc(100% - 260px) !important;
    min-height: 100vh;
    background: #F0F4FA !important;
    position: relative;
    z-index: 1;
}

/* Mempercantik Card di seluruh dashboard agar lebih premium */
.card, .stat-card, .monitoring-card-item {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03) !important;
    border: 1px solid rgba(255, 255, 255, 0.8) !important;
    transition: transform 0.2s ease, box-shadow 0.2s ease !important;
}
.card:hover, .stat-card:hover, .monitoring-card-item:hover {
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06) !important;
}
/* Fix Logo Cutoff (Overriding Sidebar CSS) */
.logo {
    display: flex !important;
    align-items: center !important;
    gap: 0px !important;
    margin-bottom: 20px !important;
    padding-left: 0px !important;
}
.logo img {
    width: 95px !important;
    height: 95px !important;
    object-fit: contain !important;
}
.logo-text {
    font-size: 26px !important;
    font-weight: 900 !important;
    letter-spacing: 0px !important;
    margin: 0 !important;
    margin-left: -8px !important;
}
</style>
