<style>
    .mg-wrap { max-width: 760px; margin: 0 auto; }
    .mg-head { text-align: center; margin-bottom: 26px; }
    .mg-head .mg-icon { width: 64px; height: 64px; border-radius: 16px; background: #e3f1ff; color: #0078ff; display: inline-flex; align-items: center; justify-content: center; font-size: 26px; margin-bottom: 10px; }
    .mg-head h2 { font-size: 28px; font-weight: 800; margin: 0 0 4px; }
    .mg-head p { color: #7a8194; margin: 0; }

    .mg-points-pill { display: inline-flex; align-items: center; gap: 8px; background: #fff; border: 1.5px solid #cbe4ff; color: #005fcc; font-weight: 700; border-radius: 30px; padding: 6px 16px; font-size: 14px; text-decoration: none; margin-top: 12px; }
    .mg-points-pill:hover { color: #005fcc; text-decoration: none; background: #eef6ff; }

    /* Game list cards */
    .mg-cards { display: flex; gap: 22px; justify-content: center; flex-wrap: wrap; }
    .mg-card { width: 250px; background: #262b3a; border-radius: 18px; padding: 22px 18px 18px; text-align: center; text-decoration: none !important; color: #fff; box-shadow: 0 10px 30px rgba(20, 24, 40, .18); transition: transform .2s, box-shadow .2s; display: block; }
    .mg-card:hover { transform: translateY(-4px); box-shadow: 0 16px 36px rgba(20, 24, 40, .28); color: #fff; }
    .mg-card.is-off { opacity: .55; pointer-events: none; }
    .mg-card .mg-art { height: 170px; display: flex; align-items: center; justify-content: center; margin-bottom: 14px; }
    .mg-card .mg-name { font-weight: 800; font-size: 17px; margin-bottom: 2px; }
    .mg-card .mg-play { color: #4da3ff; font-size: 13px; font-weight: 700; }
    .mg-card .mg-left { color: #8f97ad; font-size: 12px; margin-top: 6px; }

    .mg-mini-wheel { width: 150px; height: 150px; border-radius: 50%; border: 6px solid #ff2e57; box-shadow: 0 0 0 3px #fff inset;
        background: conic-gradient(#0078ff 0deg 36deg, #00b5ff 36deg 72deg, #ff2e57 72deg 108deg, #00b5ff 108deg 144deg, #0078ff 144deg 180deg, #00b5ff 180deg 216deg, #ff2e57 216deg 252deg, #00b5ff 252deg 288deg, #0078ff 288deg 324deg, #ff2e57 324deg 360deg); }
    .mg-mini-coin { width: 140px; height: 140px; border-radius: 50%; background: radial-gradient(circle at 35% 30%, #ffe27a, #f5a800 70%); border: 6px solid #f7c948; display: flex; align-items: center; justify-content: center; font-size: 60px; font-weight: 800; color: #b97800; box-shadow: 0 8px 24px rgba(245, 168, 0, .35); }

    .mg-mini-slot { display: flex; gap: 6px; padding: 10px; border-radius: 16px; background: linear-gradient(180deg, #ffd45a, #e59a00); box-shadow: 0 0 0 3px #7a4a00; }
    .mg-mini-slot span { width: 40px; height: 62px; line-height: 62px; text-align: center; border-radius: 8px; background: #fff; color: #e8340a; font-size: 44px; font-weight: 900; font-family: Georgia, serif; }
    .mg-mini-chart { width: 160px; height: 110px; }

    .mg-info { margin: 26px auto 0; max-width: 520px; background: #fff; border: 1px solid #e9ecf4; border-radius: 14px; padding: 16px 18px; color: #5b6275; font-size: 14px; }
    .mg-info strong { color: #222; display: block; margin-bottom: 3px; }

    /* Game panel */
    .mg-panel { max-width: 480px; margin: 0 auto; background: #262b3a; border-radius: 18px; color: #fff; overflow: hidden; box-shadow: 0 14px 40px rgba(20, 24, 40, .22); }
    .mg-panel-top { text-align: center; padding: 26px 20px 18px; border-bottom: 1px solid rgba(255, 255, 255, .07); }
    .mg-panel-top .mg-icon { width: 54px; height: 54px; border-radius: 14px; background: rgba(0,120,255,.22); color: #5cc8ff; display: inline-flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 8px; }
    .mg-panel-top h3 { font-size: 22px; font-weight: 800; margin: 0 0 2px; color: #fff; }
    .mg-panel-top p { margin: 0; color: #9aa3b8; font-size: 14px; }
    .mg-panel-body { padding: 16px 18px 20px; }
    .mg-left-bar { background: #1e2230; border-radius: 10px; padding: 11px; text-align: center; font-size: 14px; font-weight: 700; margin-bottom: 18px; }
    .mg-left-bar span { color: #00b5ff; margin-left: 6px; }
    .mg-panel-foot { text-align: center; padding: 14px; border-top: 1px solid rgba(255, 255, 255, .07); color: #9aa3b8; font-size: 12px; }

    .mg-btn { display: block; width: 100%; border: 0; border-radius: 8px; padding: 16px; font-size: 16px; font-weight: 800; letter-spacing: .5px; color: #fff; background: #0078ff; cursor: pointer; transition: background .2s, opacity .2s; }
    .mg-btn:hover { background: #0062d1; }
    .mg-btn[disabled] { opacity: .5; cursor: not-allowed; }
    .mg-btn.teal { background: #00b5ff; }
    .mg-btn.teal:hover { background: #0098d9; }

    .mg-msg { display: none; margin: 14px 0 0; padding: 12px 14px; border-radius: 10px; font-size: 14px; font-weight: 600; text-align: center; }
    .mg-msg.error { display: block; background: rgba(255,46,87,.15); color: #ff9fb3; }

    /* Result banner */
    .mg-result { display: none; text-align: center; margin: 0 0 16px; padding: 16px; border-radius: 12px; }
    .mg-result.show { display: block; animation: mgPop .4s ease; }
    .mg-result.win { background: rgba(0,181,255,.16); color: #7fd8ff; }
    .mg-result.lose { background: rgba(148, 163, 184, .14); color: #cbd5e1; }
    .mg-result .mg-result-title { font-size: 22px; font-weight: 800; margin-bottom: 2px; }
    .mg-result .mg-result-sub { font-size: 14px; }
    @keyframes mgPop { from { transform: scale(.92); opacity: 0; } to { transform: scale(1); opacity: 1; } }

    /* Wheel */
    .mg-wheel-stage { position: relative; width: 300px; height: 300px; margin: 8px auto 20px; }
    .mg-wheel-pointer { position: absolute; top: -8px; left: 50%; transform: translateX(-50%); width: 0; height: 0; border-left: 12px solid transparent; border-right: 12px solid transparent; border-top: 22px solid #0078ff; z-index: 3; filter: drop-shadow(0 2px 3px rgba(0, 0, 0, .4)); }
    .mg-wheel { width: 100%; height: 100%; border-radius: 50%; border: 6px solid #151824; box-shadow: 0 0 0 3px #3b4256; overflow: hidden; }
    .mg-wheel svg { width: 100%; height: 100%; display: block; }
    .mg-wheel-hub { position: absolute; top: 50%; left: 50%; width: 54px; height: 54px; margin: -27px 0 0 -27px; border-radius: 50%; background: #0078ff; border: 5px solid #00449a; z-index: 2; display: flex; align-items: center; justify-content: center; }
    .mg-wheel-hub i { width: 30px; height: 30px; border-radius: 50%; background: #f5a800; color: #7a4a00; display: flex; align-items: center; justify-content: center; font-style: normal; font-weight: 800; font-size: 16px; }

    /* Coin */
    .mg-coin-stage { width: 170px; height: 170px; margin: 6px auto 22px; perspective: 800px; }
    .mg-coin { position: relative; width: 100%; height: 100%; transform-style: preserve-3d; transform: rotateY(0deg); }
    .mg-coin .face { position: absolute; top: 0; left: 0; right: 0; bottom: 0; border-radius: 50%; backface-visibility: hidden; -webkit-backface-visibility: hidden; display: flex; flex-direction: column; align-items: center; justify-content: center; border: 7px solid #d4d8e2; box-shadow: 0 0 0 4px #3b4256, 0 12px 28px rgba(0, 0, 0, .35); background: radial-gradient(circle at 35% 30%, #ffffff, #b8bfcd 75%); color: #4a5266; }
    .mg-coin .face .big { font-size: 64px; font-weight: 800; line-height: 1; }
    .mg-coin .face .small { font-size: 12px; font-weight: 800; letter-spacing: 2px; margin-top: 4px; }
    .mg-coin .face.tails { transform: rotateY(180deg); background: radial-gradient(circle at 35% 30%, #ffe9a3, #e0a100 75%); border-color: #f0c040; color: #7a4a00; }
    .mg-choose { text-align: center; font-size: 13px; font-weight: 800; letter-spacing: 1px; color: #9aa3b8; margin: 0 0 10px; }
    .mg-choice-row { display: flex; gap: 14px; }
    .mg-choice-row .mg-btn { flex: 1; }

    @media (max-width: 480px) {
        .mg-wheel-stage { width: 260px; height: 260px; }
        .mg-card { width: 100%; max-width: 300px; }
    }
    /* ---- 3 Numbers (slot) ---- */
    .sl-title { text-align: center; font-size: 34px; font-weight: 900; font-style: italic; margin: 0 0 6px; background: linear-gradient(180deg, #fff2a8, #ffb400 70%); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; text-shadow: none; letter-spacing: 1px; }
    .sl-machine { position: relative; margin: 6px auto 12px; padding: 14px 16px; width: -moz-fit-content; width: fit-content; max-width: 100%; border-radius: 26px; background: linear-gradient(180deg, #ffd45a, #e59a00 55%, #ffcb3d); box-shadow: 0 0 0 4px #7a4a00, 0 0 40px rgba(255, 160, 0, .35), 0 14px 30px rgba(0, 0, 0, .4); }
    .sl-window { display: flex; gap: 6px; background: #a86500; padding: 6px; border-radius: 16px; }
    .sl-reel { position: relative; width: 84px; height: 108px; overflow: hidden; border-radius: 10px; background: linear-gradient(180deg, #cfcfcf, #fff 28%, #fff 72%, #c9c9c9); box-shadow: inset 0 0 12px rgba(0, 0, 0, .35); }
    .sl-strip { will-change: transform; }
    .sl-d { height: 108px; line-height: 108px; text-align: center; font-size: 80px; font-weight: 900; color: #e8340a; -webkit-text-stroke: 2px #0f4a44; font-family: Georgia, "Times New Roman", serif; }
    .sl-prize { text-align: center; height: 34px; margin: 0 0 10px; font-size: 26px; font-weight: 900; color: #ffd45a; letter-spacing: 1px; }
    @media (max-width: 480px) {
        .sl-reel { width: 68px; height: 92px; }
        .sl-d { height: 92px; line-height: 92px; font-size: 66px; }
    }

    /* ---- Up or Down (trade) ---- */
    .tr-wrap { max-width: 1040px; margin: 0 auto; background: #0d1216; border-radius: 16px; color: #e6eaee; overflow: hidden; box-shadow: 0 14px 40px rgba(10, 14, 18, .35); }
    .tr-grid { display: flex; flex-wrap: wrap; }
    .tr-chart-col { flex: 1 1 560px; min-width: 0; position: relative; background: #0a0f12; }
    .tr-side { flex: 0 0 300px; max-width: 100%; padding: 18px; background: #12191e; border-left: 1px solid rgba(255, 255, 255, .06); }
    .tr-chart-top { position: absolute; top: 12px; left: 12px; right: 12px; display: flex; justify-content: space-between; align-items: center; z-index: 2; pointer-events: none; }
    .tr-pair { background: rgba(255, 255, 255, .06); border: 1px solid rgba(255, 255, 255, .08); border-radius: 8px; padding: 7px 12px; font-weight: 800; font-size: 13px; letter-spacing: 1px; color: #00b5ff; }
    .tr-live { font-weight: 800; font-size: 15px; color: #00b5ff; }
    #trChart { display: block; width: 100%; height: 400px; }
    .tr-status { display: none; position: absolute; left: 12px; bottom: 12px; z-index: 2; background: rgba(13, 18, 22, .88); border: 1px solid rgba(0,181,255,.4); border-radius: 10px; padding: 9px 14px; font-size: 13px; font-weight: 700; color: #00b5ff; }
    .tr-status.show { display: block; }
    .tr-status b { color: #fff; }

    .tr-box { border: 1px solid rgba(255, 255, 255, .16); border-radius: 8px; padding: 6px 10px 8px; margin-bottom: 12px; position: relative; }
    .tr-box > label { position: absolute; top: -9px; left: 8px; background: #12191e; padding: 0 5px; font-size: 11px; color: #8d99a5; margin: 0; }
    .tr-amount { display: flex; align-items: center; gap: 6px; }
    .tr-amount button { border: 0; background: transparent; color: #00b5ff; font-size: 20px; font-weight: 800; width: 34px; height: 34px; cursor: pointer; }
    .tr-amount input { flex: 1; min-width: 0; background: transparent; border: 0; color: #fff; text-align: center; font-size: 18px; font-weight: 800; outline: none; -moz-appearance: textfield; }
    .tr-amount input::-webkit-outer-spin-button, .tr-amount input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    .tr-box select { width: 100%; background: transparent; border: 0; color: #fff; font-size: 15px; padding: 6px 0; outline: none; }
    .tr-box select option { background: #12191e; color: #fff; }
    .tr-payout { text-align: center; padding: 12px 8px; border: 1px solid rgba(255, 255, 255, .08); border-radius: 8px; margin-bottom: 12px; background: rgba(255, 255, 255, .02); }
    .tr-payout .big { font-size: 34px; font-weight: 900; color: #00b5ff; line-height: 1.1; }
    .tr-payout .sub { font-size: 12px; color: #00b5ff; font-weight: 700; }
    .tr-btn { display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; border: 0; border-radius: 8px; padding: 15px; font-size: 15px; font-weight: 800; letter-spacing: 1px; color: #fff; cursor: pointer; margin-bottom: 10px; }
    .tr-btn.up { background: #0078ff; }
    .tr-btn.up:hover { background: #0062d1; }
    .tr-btn.down { background: #ff2e57; }
    .tr-btn.down:hover { background: #e0143f; }
    .tr-btn[disabled] { background: #2a343c; color: #6b7883; cursor: not-allowed; }
    .tr-balance { display: flex; justify-content: space-between; font-size: 13px; color: #8d99a5; margin-bottom: 14px; }
    .tr-balance b { color: #00b5ff; }
    .tr-msg { display: none; margin: 4px 0 10px; padding: 10px 12px; border-radius: 8px; font-size: 13px; font-weight: 600; text-align: center; }
    .tr-msg.error { display: block; background: rgba(255,46,87,.15); color: #ff9fb3; }
    .tr-msg.note { display: block; background: rgba(0,120,255,.22); color: #8fd6ff; }
    .tr-result { display: none; margin: 0 0 12px; padding: 14px; border-radius: 10px; text-align: center; }
    .tr-result.show { display: block; animation: mgPop .4s ease; }
    .tr-result.win { background: rgba(0,181,255,.16); color: #7fd8ff; }
    .tr-result.lose { background: rgba(255,46,87,.15); color: #ff9fb3; }
    .tr-result .t { font-size: 20px; font-weight: 800; }
    .tr-result .s { font-size: 13px; margin-top: 2px; }
    .tr-foot { text-align: center; color: #8d99a5; font-size: 12px; margin-top: 6px; }
    @media (max-width: 860px) {
        .tr-side { flex: 1 1 100%; border-left: 0; border-top: 1px solid rgba(255, 255, 255, .06); }
        #trChart { height: 300px; }
    }
</style>
