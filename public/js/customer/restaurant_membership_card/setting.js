$(function () {
    dataSettingMembershipCard();
});

async function dataSettingMembershipCard() {
    let id = ['condition-setting-restaurant-membership-card', 'point-setting-restaurant-membership-card', 'benefit-setting-restaurant-membership-card', 'level-setting-restaurant-membership-card'];
    await ckEditorTemplate(id);
}


