<?php

namespace constants;


define('SESSION_JAVA_ACCOUNT', 'SESSION_JAVA_ACCOUNT');  // KEY_SESSION_ACCOUNT
define('SESSION_JAVA_TOKEN', 'SESSION_JAVA_TOKEN'); // KEY_ACCESS_TOKEN
define('SESSION_JAVA_DOMAIN', 'SESSION_JAVA_DOMAIN'); // KEY_DOMAIN_URL
define('SESSION_JAVA_BASE_URL', 'SESSION_JAVA_BASE_URL'); // KEY_BASE_URL
define('SESSION_JAVA_TOKEN_NOTIFICATION', 'SESSION_JAVA_TOKEN_NOTIFICATION'); //KEY_TOKEN_NOTIFICATION
define('SESSION_JAVA_TOKEN_OAUTH', 'SESSION_JAVA_TOKEN_OAUTH'); // KEY_TOKEN_OAUTH
define('SESSION_JAVA_KEY_TOKEN_OAUTH_ALOLINE', 'SESSION_JAVA_KEY_TOKEN_OAUTH_ALOLINE'); //
define('SESSION_JAVA_KEY_SESSION', 'SESSION_JAVA_KEY_SESSION'); // KEY_ACCESS_TOKEN


/**
 * SESSION NODE
 */

define('SESSION_NODE_DOMAIN', 'SESSION_NODE_DOMAIN'); // KEY_DOMAIN_CHAT
define('SESSION_NODE_USER_ID_NODE', 'SESSION_NODE_USER_ID_NODE'); // KEY_USER_ID_CHAT
define('SESSION_NODE_KEY_BASE_URL_ADS', 'SESSION_NODE_KEY_BASE_URL_ADS'); // KEY_BASE_URL_ADS
define('SESSION_NODE_KEY_BASE_URL_ADS_MEDIA', 'SESSION_NODE_KEY_BASE_URL_ADS_MEDIA'); // KEY_BASE_URL_ADS
define('SESSION_NODE_ACCESS_TOKEN_NODE', 'SESSION_NODE_ACCESS_TOKEN_NODE'); //KEY_ACCESS_TOKEN_NODE
define('SESSION_NODE_CONFIG_NODE', 'SESSION_NODE_CONFIG_NODE');  // KEY_CONFIG_NODE
define('SESSION_NODE_KEY_CONFIG_NODE_ALOLINE', 'SESSION_NODE_KEY_CONFIG_NODE_ALOLINE');  // KEY_CONFIG_NODE
define('SESSION_NODE_CONFIG_NODE_ALL', 'SESSION_NODE_CONFIG_NODE_ALL'); // KEY_CONFIG_NODE_ALL
define('SESSION_NODE_KEY_TOKEN_NOTIFICATION', 'SESSION_NODE_KEY_TOKEN_NOTIFICATION'); // KEY_TOKEN_NOTIFICATION_CHAT
define('SESSION_NODE_STATUS_LOGIN', 'SESSION_NODE_STATUS_LOGIN'); //STATUS_LOGIN_CHAT
define('SESSION_NODE_KEY_ACCESS_TOKEN_CHAT', 'SESSION_NODE_KEY_ACCESS_TOKEN_CHAT'); //STATUS_LOGIN_CHAT
define('SESSION_NODE_KEY_ACCESS_TOKEN_CHAT_MEDIA', 'SESSION_NODE_KEY_ACCESS_TOKEN_CHAT_MEDIA'); //STATUS_LOGIN_CHAT

define('SESSION_PERMISSION', 'SESSION_PERMISSION');
define('SESSION_KEY_LEVEL', 'SESSION_KEY_LEVEL');
define('SESSION_RESTAURANT', 'SESSION_RESTAURANT');
define('SESSION_KEY_TMS', 'SESSION_KEY_TMS');
define('SESSION_KEY_ACCESS_TOKEN_FACEBOOK', 'SESSION_KEY_ACCESS_TOKEN_FACEBOOK');
define('SESSION_KEY_FACEBOOK_URL', 'SESSION_KEY_FACEBOOK_URL');
define('SESSION_KEY_LENGTH_DATA_TABLE', 'SESSION_KEY_LENGTH_DATA_TABLE');
define('SESSION_KEY_DATA_SETTING', 'SESSION_KEY_DATA_SETTING');
define('SESSION_KEY_AVATAR', 'SESSION_KEY_AVATAR');
define('SESSION_KEY_CONFIG', 'SESSION_KEY_CONFIG');
define('SESSION_KEY_VERSION_DASHBOARD', 'SESSION_KEY_VERSION_DASHBOARD');
define('SESSION_KEY_SESSION_USER_FACEBOOK', 'SESSION_KEY_SESSION_USER_FACEBOOK');
define('SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT', 'SESSION_KEY_ID_PAGE_FACEBOOK_CONNECT');
define('SESSION_KEY_PAGE_FACEBOOK_CONNECTED', 'SESSION_KEY_PAGE_FACEBOOK_CONNECTED');
define('SESSION_KEY_IS_ENABLE_RESTAURANT_MEMBERSHIP_CARD', 'SESSION_KEY_IS_ENABLE_RESTAURANT_MEMBERSHIP_CARD');
define('SESSION_STATUS_SERVER', 'SESSION_STATUS_SERVER');
define('SESSION_KEY_DATA_RESTAURANT', 'SESSION_KEY_DATA_RESTAURANT');
define('SESSION_KEY_PATH_ORDER', 'SESSION_KEY_PATH_ORDER');
define('SESSION_KEY_PATH_ORDER_VERSION', 'SESSION_KEY_PATH_ORDER_VERSION');
define('SESSION_KEY_AVATAR_DEFAULT', 'SESSION_KEY_AVATAR_DEFAULT');
define('SESSION_KEY_PERMISSION_TALLEST', 'SESSION_KEY_PERMISSION_TALLEST');
define('SESSION_KEY_ACTIVE_FACEBOOK', 'SESSION_KEY_ACTIVE_FACEBOOK');
define('SESSION_KEY_HOUR_TO_TAKE_REPORT', 'SESSION_KEY_HOUR_TO_TAKE_REPORT');
define('SESSION_KEY_SETTING_RESTAURANT', 'SESSION_KEY_SETTING_RESTAURANT');
define('SESSION_KEY_CURRENT_PATH', 'SESSION_KEY_CURRENT_PATH');
define('SESSION_KEY_CURRENT_PAGE_FACEBOOK_CONNECT', 'SESSION_KEY_CURRENT_PAGE_FACEBOOK_CONNECT');
define('SESSION_KEY_SHOW_LOG_NAVBAR', 'SESSION_KEY_SHOW_LOG_NAVBAR');
define('SESSION_KEY_CHECK_REFRESH_TOKEN', 'SESSION_KEY_CHECK_REFRESH_TOKEN');
define('SESSION_KEY_BRAND_ID', 'SESSION_KEY_BRAND_ID');
define('SESSION_KEY_BRAND_ID_DEFAULT', 'SESSION_KEY_BRAND_ID_DEFAULT');
define('SESSION_KEY_BRAND_ID_CURRENT', 'SESSION_KEY_BRAND_ID_CURRENT');
define('SESSION_KEY_DATA_BRAND', 'SESSION_KEY_DATA_BRAND');
define('SESSION_KEY_DATA_CURRENT_BRAND', 'SESSION_KEY_DATA_CURRENT_BRAND');
define('SESSION_KEY_SETTING_CURRENT_BRAND', 'SESSION_KEY_SETTING_CURRENT_BRAND');
define('SESSION_KEY_OPTION_BRAND', 'SESSION_KEY_OPTION_BRAND');
define('SESSION_KEY_BRANCH_ID', 'SESSION_KEY_BRANCH_ID');
define('SESSION_KEY_BRANCH_ID_DEFAULT', 'SESSION_KEY_BRANCH_ID_DEFAULT');
define('SESSION_KEY_BRANCH_ID_CURRENT', 'SESSION_KEY_BRANCH_ID_CURRENT');
define('SESSION_KEY_DATA_BRANCH', 'SESSION_KEY_DATA_BRANCH');
define('SESSION_KEY_DATA_CURRENT_BRANCH', 'SESSION_KEY_DATA_CURRENT_BRANCH');
define('SESSION_KEY_SETTING_CURRENT_BRANCH', 'SESSION_KEY_SETTING_CURRENT_BRANCH');
define('SESSION_KEY_OPTION_BRANCH', 'SESSION_KEY_OPTION_BRANCH');
define('SESSION_KEY_NAME_BRAND', 'SESSION_KEY_NAME_BRAND');
define('SESSION_KEY_NAME_BRANCH', 'SESSION_KEY_NAME_BRANCH');
define('SESSION_KEY_DATA_ALOLINE_CUSTOMER', 'SESSION_KEY_DATA_ALOLINE_CUSTOMER');


/**
 * ENUM REPORT
 * */
define('ENUM_REPORT_TYPE_DEFAULT', -1); // Mặc định
define('ENUM_REPORT_TYPE_HOUR', 0); // Lấy theo giờ
define('ENUM_REPORT_TYPE_DAY', 1); // Lấy theo ngày
define('ENUM_REPORT_TYPE_WEEK', 2); // Lấy theo tuần
define('ENUM_REPORT_TYPE_MONTH', 3); // Lấy theo tháng
define('ENUM_REPORT_TYPE_NEAREST_THREE_MONTHS', 4); // Lấy theo 3 tháng gần nhất
define('ENUM_REPORT_TYPE_YEAR', 5); // Lấy theo năm
define('ENUM_REPORT_TYPE_THREE_YEAR', 6); // Lấy theo 3 năm gần nhất
define('ENUM_REPORT_TYPE_ALL_MONTH', 7); // Lấy tất cả thời gian tháng
define('ENUM_REPORT_TYPE_ALL_YEAR', 8); // Lấy tất cả thời gian năm
define('ENUM_REPORT_TYPE_YESTERDAY', 9); // Lấy theo ngày hôm qua
define('ENUM_REPORT_TYPE_LAST_MONTH', 10); // Lấy theo tháng trước
define('ENUM_REPORT_TYPE_LAST_YEAR', 11); // Lấy theo năm trước
define('ENUM_REPORT_TYPE_OPTION_HOUR', 12); // Lấy tuỳ chọn theo giờ
define('ENUM_REPORT_TYPE_OPTION_DAY', 13); // Lấy tuỳ chọn theo ngày
define('ENUM_REPORT_TYPE_OPTION_WEEK', 14); // Lấy tuỳ chọn theo tuần
define('ENUM_REPORT_TYPE_OPTION_MONTH', 15); // Lấy tuỳ chọn theo tháng
define('ENUM_REPORT_TYPE_OPTION_YEAR', 16); // Lấy tuỳ chọn theo năm

/* * ======================== ENUM GATEWAY PROJECT_ID  ======================== * */
define('ENUM_PROJECT_ID_OAUTH', 8888); // PROJECT_ID_OAUTH
define('ENUM_PROJECT_ID_OAUTH2', 88888); // PROJECT_ID_OAUTH2
define('ENUM_PROJECT_ID_OAUTH_ALOLINE', 12345); // PROJECT_ID_OAUTH2
define('ENUM_PROJECT_ID_ALOLINE', 8082); // PROJECT_ID_ALOLINE
define('ENUM_PROJECT_ID_TMS', 8095); // PROJECT_ID_TMS
define('ENUM_PROJECT_ID_ORDER', 8095); // PROJECT_ID_ORDER
define('ENUM_PROJECT_ID_ORDER_VERSION', 809494); // PROJECT_ID_ORDER
define('ENUM_PROJECT_ID_ORDER2', 80948094); // PROJECT_ID_ORDER2
define('ENUM_PROJECT_ID_SUPPLIER', 8087); // PROJECT_ID_SUPPLIER
define('ENUM_PROJECT_ID_ADMIN', 8088); // PROJECT_ID_ADMIN
define('ENUM_PROJECT_ID_CHAT', 1484); // PROJECT_ID_CHAT
define('ENUM_PROJECT_ID_LOGS', 1487); // PROJECT_ID_LOGS
define('ENUM_PROJECT_ID_UPLOAD', 1488); // PROJECT_ID_UPLOAD
define('ENUM_PROJECT_ID_OAUTH_NODE', 9999); // PROJECT_ID_OAUTH_NODEƒ1489
define('ENUM_PROJECT_ID_REPORT_NODE', 1486); // PROJECT_ID_REPORT_NODE
define('ENUM_PROJECT_ID_PROMOTION', 0); // PROJECT_ID_REPORT_NODE
define('ENUM_PROJECT_ID_SALE', 1600); // PROJECT_ID_SALE
define('ENUM_PROJECT_ID_REPORT_NODE_V2', 1489); // PROJECT_ID_SALE
define('ENUM_PROJECT_ID_ALOLINE_TIMELINE', 7006); //PROJECT_ID_ALOLIN6
define('ENUM_PROJECT_ID_ALOLINE_USER', 7002); //PROJECT_ID_ALOLIN6
define('ENUM_PROJECT_ID_INVOICES', 1490); //PROJECT_ID_ALOLIN6
define('ENUM_PROJECT_ID_UPLOAD_V2', 9007);
define('ENUM_PROJECT_ID_CONVERSATION', 7024);
/* * ======================== ENUM GATEWAY METHOD  ======================== * */
define('ENUM_METHOD_GET', 0);  // METHOD_GET
define('ENUM_METHOD_POST', 1); // METHOD_POST


/* * ======================== ENUM PREFIX PROJECT  ======================== * */
define('ENUM_PREFIX_SUPPLIER', '/v2');
define('ENUM_PREFIX_OAUTH_ALOLINE', '/v3');
define('ENUM_PREFIX_ALOLINE', '/v1');
define('ENUM_PREFIX_ORDER', '/v4');
define('ENUM_PREFIX_TMS', '/v4');
define('ENUM_PREFIX_ADMIN', '/v2');
define('ENUM_PREFIX_INVOICE', '/v1');
define('ENUM_PREFIX_REPORT', '/v1');
//define('ENUM_PREFIX_OAUTH', '/v2');
define('ENUM_PREFIX_OAUTH', '/v4');
define('ENUM_PREFIX_LOG', '/v2');
define('ENUM_PREFIX_REPORT_ADMIN', '/v1');
define('ENUM_PREFIX_UPLOAD', '/v2');
define('ENUM_PREFIX_CONVERSATION', '/v1');
define('ENUM_PREFIX_CHAT', '/v1');

/**
 * PROJECT_ID
 */
define('ENUM_PROJECT_ID_JAVA_OAUTH', 8888);
define('ENUM_PROJECT_ID_JAVA_DASHBOARD', 8095);
define('ENUM_PROJECT_ID_JAVA_REPORT', 1489);
define('ENUM_PROJECT_ID_JAVA_INVOICES', 1490);

define('ENUM_PROJECT_ID_NEST_LOGS', 7017);
define('ENUM_PROJECT_ID_NEST_UPLOAD', 9007);
define('ENUM_PROJECT_ID_NEST_USER', 7002);
define('ENUM_PROJECT_ID_NEST_TIMELINE', 7006);
define('ENUM_PROJECT_ID_NEST_COMMENT', 7007);
define('ENUM_PROJECT_ID_NEST_CONVERSATION', 7024);
define('ENUM_PROJECT_ID_NEST_MESSAGE', 7025);
define('ENUM_PROJECT_ID_NEST_STICKER', 7028);
define('ENUM_PROJECT_ID_NEST_REMINDER', 7027);

/**
 * PROJECT_ID VERSION PREFIX
 */
define('ENUM_PREFIX_JAVA_OAUTH', 'v4');
define('ENUM_PREFIX_JAVA_DASHBOARD', 'v4');
define('ENUM_PREFIX_JAVA_REPORT', 'v2');
define('ENUM_PREFIX_JAVA_INVOICES', 'v1');

define('ENUM_PREFIX_NEST_LOGS', 'v2');
define('ENUM_PREFIX_NEST_UPLOAD', 'v2');
define('ENUM_PREFIX_NEST_USER', 'v2');
define('ENUM_PREFIX_NEST_TIMELINE', 'v2');
define('ENUM_PREFIX_NEST_COMMENT', 'v2');
define('ENUM_PREFIX_NEST_CONVERSATION', 'v1');
define('ENUM_PREFIX_NEST_MESSAGE', 'v1');
define('ENUM_PREFIX_NEST_STICKER', 'v1');
define('ENUM_PREFIX_NEST_REMINDER', 'v1');

/* * ========================  ENUM STATUS ======================== * */
define('ENUM_HTTP_STATUS_CODE_SUCCESS', 200); // STATUS_SUCCESS
define('ENUM_HTTP_STATUS_CODE_UPDATE', 205); // STATUS_CONFIRM
define('ENUM_HTTP_STATUS_CODE_CONFIRM_SUPPLIER', 300); // STATUS_CONFIRM_SUPPLIER
define('ENUM_HTTP_STATUS_CODE_ERROR', 500); // STATUS_ERROR
define('ENUM_HTTP_STATUS_CODE_AUTH', 401);
define('ENUM_HTTP_STATUS_CODE_DATA_INVALID', 400);
define('ENUM_STATUS_GET_ALL', -1);
define('ENUM_STATUS_GET_ACTIVE', 1);
define('ENUM_STATUS_OPENING', 0);
define('ENUM_STATUS_PAYMENT', 1);
define('ENUM_STATUS_DONE', 2);
define('ENUM_STATUS_MERGED', 3);
define('ENUM_STATUS_COMPLETE', 4);
define('ENUM_STATUS_DEBIT', 5);
define('ENUM_STATUS_PENDING', 6);
define('ENUM_STATUS_DELIVERING', 7);
define('ENUM_STATUS_CANCELLED', 8);
define('ENUM_STATUS_UNKNOWN', 9);
define('ENUM_STATUS_WAITING_CONFIRM', 1);
define('ENUM_STATUS_CONFIRM', 2);

/* * ======================== ENUM  LIMIT  ======================== * */
define('ENUM_DEFAULT_LIMIT_1000', 1000); // LIMIT_1000
define('ENUM_DEFAULT_LIMIT_50000', 50000); // LIMIT_1000
define('ENUM_DEFAULT_LIMIT_100', 100); // LIMIT_100
define('ENUM_DEFAULT_LIMIT_50', 50); // LIMIT_50
define('ENUM_DEFAULT_LIMIT_20', 20); // LIMIT_20
define('ENUM_DEFAULT_LIMIT_10', 10); // LIMIT_10
define('ENUM_DEFAULT_LIMIT_1', 1); // LIMIT_1
define('ENUM_DEFAULT_PAGE', 1); // PAGE_DEFAULT

/* * ======================== ENUM SELECT  ======================== * */
define('ENUM_SELECTED', 1);  // SELECTED
define('ENUM_DIS_SELECTED', 0); // DIS_SELECTED
define('ENUM_GET_ALL', -1); // GET_ALL
define('ENUM_DEFAULT', -1); // GET_ALL
define('ENUM_TYPE_TAG', 2);

/**
 * ENUM IDF
 */
define('ENUM_ID_NONE', ''); // NONE
define('ENUM_ID_GET_ALL', -1); // GET_ALL
define('ENUM_ID_DEFAULT', 0); // DEFAULT
define('ENUM_ID_UPDATE', 1); // UPDATE

/**
 * ENUM MEDIA
 */
define('ENUM_MEDIA_VIDEO', 0); // NONE
define('ENUM_MEDIA_IMAGE', 1); // NONE
define('ENUM_MEDIA_GET_ALL', -1); // NONE


/**
 * ENUM ROLE EMPLOYEE
 *
 */
define('ENUM_ROLE_TYPE_GET_ALL', -1); // STATUS_CONFIRM
define('ENUM_ROLE_TYPE_OFFICE', 1); // STATUS_CONFIRM
define('ENUM_ROLE_TYPE_BUSINESS', 2); // STATUS_CONFIRM
define('ENUM_ROLE_TYPE_PRODUCTION', 3); // STATUS_CONFIRM
define('ENUM_ROLE_TYPE_MARKETING', 4); // STATUS_CONFIRM


/**
 * ENUM
 */
define('ENUM_ORDER_SUPPLIER_INTERNAL_WEB', "1,2"); // STATUS_CONFIRM
define('ENUM_ORDER_SUPPLIER_INTERNAL_PENDING', 205); // STATUS_CONFIRM

/**
 * ENUM MATERIAL CATEGORY PARENT ID
 */
define('ENUM_MATERIAL_CATEGORY_PARENT_GET_ALL', -1); // MaterialCategoryParentId -> GET_ALL
define('ENUM_MATERIAL_CATEGORY_PARENT_MATERIAL', 1); // MaterialCategoryParentId -> MATERIAL
define('ENUM_MATERIAL_CATEGORY_PARENT_GOODS', 2); // MaterialCategoryParentId -> GOODS
define('ENUM_MATERIAL_CATEGORY_PARENT_INTERNAL', 3); // MaterialCategoryParentId -> INTERNAL
define('ENUM_MATERIAL_CATEGORY_PARENT_OTHER', 12); // MaterialCategoryParentId -> OTHER

/**
 * ENUM KITCHEN TYPE BUILD DATA
 */
define('ENUM_KITCHEN_BUILD_DATA_BEER_BAR_GOODS', 0); // KitchenTypeBuildData -> BEER_BAR_GOODS
define('ENUM_KITCHEN_BUILD_DATA_KITCHEN', 1); // KitchenTypeBuildData -> KITCHEN
define('ENUM_KITCHEN_BUILD_DATA_CASHIER', 2); // KitchenTypeBuildData -> CASHIER
define('ENUM_KITCHEN_BUILD_DATA_FISH_BOWL', 3); // KitchenTypeBuildData -> FISH_BOWL
define('ENUM_KITCHEN_BUILD_DATA_TOPPING', 4); // KitchenTypeBuildData -> TOPPING

/**
 * ENUM INVENTORY REPORT STATUS
 */

define('ENUM_INVENTORY_REPORT_STATUS_PENDING', 0); // InventoryReportStatusEnum -> PENDING
define('ENUM_INVENTORY_REPORT_STATUS_WAITING_CONFIRM', 1); // InventoryReportStatusEnum -> WAITING_CONFIRM
define('ENUM_INVENTORY_REPORT_STATUS_CONFIRMED', 2); // InventoryReportStatusEnum -> CONFIRMED
define('ENUM_INVENTORY_REPORT_STATUS_CANCELLED', 3); // InventoryReportStatusEnum -> CANCELLED
define('ENUM_INVENTORY_REPORT_STATUS_GET_ALL', '0,1,2,3'); // InventoryReportStatusEnum -> GET_ALL
define('ENUM_INVENTORY_REPORT_STATUS_GET_NOT_CANCEL', '0,1,2'); // InventoryReportStatusEnum -> GET_NOT_CANCEL

/**
 * ENUM LIABILITIES
 */
define('ENUM_LIABILITIES_GET_ALL', -1); //GET_ALL
define('ENUM_LIABILITIES_GET_DEBT', 0); //GET_DEBT
define('ENUM_LIABILITIES_GET_LIABILITIES', 1); //GET_LIABILITIES

/**
 * ENUM WARNING ORIGINAL PRICE FOOD
 */

define('ENUM_WARNING_ORIGINAL_PRICE_SAFE', 'An toàn'); //GET_ALL
define('ENUM_WARNING_ORIGINAL_PRICE_WARNING', 'Cảnh báo'); //GET_ALL
define('ENUM_WARNING_ORIGINAL_PRICE_DANGER', 'Nguy hiểm'); //GET_ALL
define('ENUM_WARNING_ORIGINAL_PRICE_PRIMARY', 'Tạm ổn'); //GET_ALL

/**
 * ENUM DAY OF WEEK BEER STORE
 */
define('ENUM_MONDAY_BEER_STORE', 0); //MONDAY
define('ENUM_TUESDAY_BEER_STORE', 1); //TUESDAY
define('ENUM_WEDNESDAY_BEER_STORE', 2); //WEDNESDAY
define('ENUM_THURSDAY_BEER_STORE', 3); //THURSDAY
define('ENUM_FRIDAY_BEER_STORE', 4); //FRIDAY
define('ENUM_SATURDAY_BEER_STORE', 5); //SATURDAY
define('ENUM_SUNDAY_BEER_STORE', 6); //SUNDAY

/**
 * ENUM TYPE FOOD
 */

define('ENUM_TYPE_FOOD', 0); //ENUM_FOOD_TYPE
define('ENUM_TYPE_FOOD_COMBO', 1); //ENUM_TYPE_FOOD_COMBO
define('ENUM_TYPE_FOOD_ADDITION', 2); //ENUM_TYPE_FOOD_ADDITION


/**
 * ENUM CATEGORY FOOD
 * */

define('ENUM_FOOD_CATEGORY_PRODUCT', 0);
define('ENUM_FOOD_CATEGORY_FOOD', 1);
define('ENUM_FOOD_CATEGORY_DRINK', 2);
define('ENUM_FOOD_CATEGORY_OTHER', 3);
define('ENUM_FOOD_CATEGORY_SEA_FOOD', 4);
define('ENUM_FOOD_CATEGORY_COMBO', 6);

/**
 * ENUM DISCOUNT TYPE E-INVOICE
 */
define('ENUM_DISCOUNT_FOOD', 2);
define('ENUM_DISCOUNT_BILL', 1);
define('ENUM_DISCOUNT_DRINK', 3);


/**
 * API_AUTH
 */

define('API_AUTH_GET_SETTING', '/employees/settings'); //api_auth.API_GET_SETTING
define('API_AUTH_POST_LOGIN_JAVA', '/employees/login'); //api_auth.API_LOGIN
define('API_AUTH_GET_CONFIG', '/configs?restaurant_name=%s&project_id=%s'); //api_auth.API_GET_CONFIG
define('API_AUTH_POST_FORGOT_PASSWORD', '/employees/forgot-password'); //api_auth.API_FORGOT_PASSWORD
define('API_POST_VERIFY_CODE', '/employees/verify-code');
define('API_AUTH_POST_VERIFY_CHANGE_PASSWORD', '/employees/verify-change-password'); //api_auth.API_CHANGE_PASSWORD
define('API_AUTH_POST_LOGIN_ALO_LINE', '/customers/login'); //api_auth.API_LOGIN_ALOLINE
define('API_AUTH_POST_LOGIN_NODE', '/oauth-login-nodejs/login'); // api_chat.API_POST_LOGIN
define('API_AUTH_POST_REFRESH_TOKEN', '/employees/refresh-token'); // api.API_POST_REFRESH_TOKEN
define('API_AUTH_POST_LOGIN_ALOLINE_RESTAURANT', '/restaurants/assign-customer-partner'); // api.API_POST_LOGIN_ALOLINE_RESTAURANT
define('API_AUTH_POST_LOGOUT_ALOLINE_RESTAURANT', '/restaurants/logout-restaurant'); // api.API_POST_LOGOUT_ALOLINE_RESTAURANT
//define('API_AUTH_POST_EMPLOYEE_FORGOT_PASSWORD','/employees/forgot-password'); // api.API_POST_FORGOT_PASSWORD
define('API_AUTH_POST_CHANGE_PASSWORD', '/employees/%s/change-password');
//define('API_AUTH_GET_CONFIG_NODE','/oauth-configs-nodejs/get-configs?secret_key=%s&type=%s');
define('API_AUTH_API_CREATE_EMPLOYEE', '/create-employee');
define('API_AUTH_PUST_TOKEN_JAVA', '/register-device');
define('API_AUTH_PUSh_TOKEN_LOGOUT_JAVA', '/employees/push-token/logout');
define('API_AUTH_GET_SESSIONS_JAVA', '/sessions');

/**
 * API_CHAT
 */
define('API_MESSAGE_GET_CATEGORY_STICKER', '/stickers/category'); //api_chat.API_GET_CATEGORY_STICKER_CONVERSATION
define('API_MESSAGE_GET_STICKER', '/stickers/%s'); // api_chat.API_GET_STICKER_CONVERSATION, api_chat.API_GET_STICKER_CATEGORY_CHAT
define('API_MESSAGE_GET_TAG_NAME', '/tagged-messages?page=%s&limit=%s&group_id=%s&conversation_type=%s'); // api_chat.API_GET_STICKER_CONVERSATION, api_chat.API_GET_STICKER_CATEGORY_CHAT

/**
 * Message TMS
 */

define('API_MESSAGE_TMS_GET_CONVERSATION', '/conversation/list-conversation?page=%s&limit=%s&type=%s'); //api_chat.API_GET_CONVERSATION_TMS
define('API_MESSAGE_TMS_GET_MESSAGE', '/messages?group_id=%s&page=%s&limit=%s&conversation_type=%s'); //api_chat.API_GET_MESSAGE_OF_CONVERSATION_TMS
define('API_MESSAGE_TMS_GET_MESSAGE_PAGINATION', '/messages/pagination?group_id=%s&limit=%s&random_key=%s&pre_cursor=%s&next_cursor=%s&conversation_type=%s'); //api_chat.API_GET_MESSAGE_PAGINATION_OF_CONVERSATION_TMS
define('API_MESSAGE_TMS_GET_FILE', '/message/get-message-file?page=%s&limit=%s&type=%s&group_id=%s'); //api_chat.API_GET_FILE_OF_CONVERSATION_TMS
define('API_MESSAGE_TMS_GET_PINNED_CURRENT', '/pinned-messages/get-current?group_id=%s'); //api_chat.API_GET_PINNED_CURRENT_OF_CONVERSATION_TMS
define('API_MESSAGE_TMS_GET_PINNED', '/pinned-messages?page=%s&limit=%s&status=%s&group_id=%s'); //api_chat.API_GET_PINNED_OF_CONVERSATION_TMS
define('API_MESSAGE_TMS_SUPPLIER_GET_PINNED', '/pinned-messages-order?status=%s&group_id=%s'); //api_chat.API_GET_PINNED_OF_CONVERSATION_TMS_SUPPLIER
define('API_MESSAGE_TMS_GET_VOTE', '/message-votes?page=%s&limit=%s&conversation_type=%s&group_id=%s'); //api_chat.API_GET_VOTE_OF_CONVERSATION_TMS
define('API_MESSAGE_TMS_GET_MESSAGE_NOT_SEEN', '/groups/total-unread-message'); //api_chat.API_GET_MESSAGE_NOT_SEEN_CONVERSATION_TMS
define('API_MESSAGE_TMS_POST_ADD_MEMBER', '/groups/%s/add-user'); //api_chat.API_POST_ADD_MEMBER_GROUP_CHAT
define('API_MESSAGE_POST_CREATE_PERSONAL', '/conversation/create'); //api_chat.API_POST_CREATE_PERSONAL_CONVERSATION
define('API_MESSAGE_POST_CREATE_GROUP', '/conversation/create-group?type=%s'); //api_chat.API_POST_CREATE_GROUP_CONVERSATION
define('API_MESSAGE_TMS_POST_UPDATE', '/groups/%s/update'); //api_chat.API_POST_UPDATE_CONVERSATION_TMS
define('API_MESSAGE_TMS_GET_DETAIL', '/groups/%s/detail'); //api_chat.API_GET_DETAIL_CONVERSATION_TMS
define('API_MESSAGE_TMS_POST_REMOVE_MEMBER', '/groups/%s/remove-user'); //api_chat.API_POST_REMOVE_MEMBER_GROUP_CHAT

define('API_MESSAGE_TMS_GET_LIST_MEMBER', '/conversation/%s/list-members?page=%s&limit=%s'); //api_chat.API_POST_PINNED_CONVERSATION_TMS

/**
 * Message Supplier
 */

define('API_MESSAGE_SUPPLIER_GET_CONVERSATION', '/groups-tms-supplier?page=%s&limit=%s&keyword=%s&app_name=tms'); //api_chat.API_GET_CONVERSATION_SUPPLIER
define('API_MESSAGE_SUPPLIER_GET_MESSAGE', '/message-tms-supplier?group_id=%s&page=%s&limit=%s'); //api_chat.API_GET_MESSAGE_OF_CONVERSATION_SUPPLIER
define('API_MESSAGE_SUPPLIER_GET_DETAIL', '/group-tms-supplier/%s/detail'); //api_chat.API_GET_DETAIL_CONVERSATION_SUPPLIER
define('API_MESSAGE_POST_DISBAND_GROUP', '/conversation/%s/disband'); //api_chat.API_POST_REMOVE_GROUP_CHAT
define('API_MESSAGE_SUPPLIER_POST_GROUPS_AUTHORIZATION', 'api/groups/%s/authorization'); //api_chat.API_POST_GROUPS_AUTHORIZATION

/**
 * Message Support
 */
define('API_MESSAGE_SUPPORT_GET_MESSAGE', '/message-suport/message-pagination-by-room-web?_id=%s&limitMessage=%s&page=%s'); //api_chat.API_GET_MESSAGE

/**
 * Upload
 */
define('API_UPLOAD_POST_FILE', '/api-upload/upload-file-by-user/%s/%s'); //api_node.API_POST_MEDIA_NODE
define('API_UPLOAD_GET_FILE', '/api-upload/get-link-file-by-user?type=%s&name_file=%s'); //api_node.API_GET_MEDIA_NODE


/**
 * Upload v2
 */
define('API_UPLOAD_V2_POST_FILE', '/api/v2/media/upload'); //api_node.API_POST_MEDIA_NODE
define('API_UPLOAD_GET_FILE_GENERATE', '/media/generate'); //api_node.API_GET_MEDIA_NODE


/**
 * Report
 */

define('API_REPORT_GET_SEARCH_CUSTOMER', '/user/get-user-by-phone?page=%s&limit=%s'); //api_node.API_GET_SEARCH_CUSTOMER
/**
 * Báo cáo thông tin Công ty/Nhà hàng
 */
//define('API_REPORT_GET_PROFILE', '/report/aloline/restaurant-profile');//api_node.API_GET_RESTAURANT_PROFILE_REPORT
define('API_REPORT_GET_PROFILE', '/order-restaurant-information-in-aloline'); //api_node.API_GET_RESTAURANT_PROFILE_REPORT
/**
 * Trans: Báo cáo cơ cấu hạng thẻ thành viên
 */
//define('API_REPORT_GET_MEMBERSHIP_CARD', '/report/aloline/restaurant-membership-card');//api_node.API_GET_RESTAURANT_MEMBERSHIP_CARD_REPORT
define('API_REPORT_GET_MEMBERSHIP_CARD', '/order-restaurant-membership-card-level');
/**
 * Trans: Báo cáo VAT
 */
//define('API_REPORT_GET_MEMBERSHIP_CARD', '/report/aloline/restaurant-membership-card');//api_node.API_GET_RESTAURANT_MEMBERSHIP_CARD_REPORT
define('API_REPORT_GET_VAT', '/window-order-report-data/vat?restaurant_brand_id=%s&branch_id=%s&date_string=%s&from_date=%s&to_date=%s&report_type=%s'); //api_node.API_GET_RESTAURANT_MEMBERSHIP_CARD_REPORT
/**
 * Trans: Review Công ty/Nhà hàng
 */
define('API_REPORT_GET_REVIEW', '/report/aloline/list-branch-review?page=%s&limit=%s&is_reply=%s&rate=%s&from=%s&to=%s&branch_id=%s&customer_id=%s'); //api_node.API_GET_REVIEW_CUSTOMER
define('API_REPORT_POST_REPLY_REVIEW', '/branch-reviews-comments-by-admin-restaurant'); //api_node.API_POST_REPLY_REVIEW_CUSTOMER
/**
 * Trans: Báo cáo khoản thu
 */
define('API_REPORT_GET_REASON_REVENUE', '/report/order/reason-revenue?brand_id=%s&branch_id=%s&type=%s&time=%s'); //api_node.API_GET_REASON_REVENUE_REPORT
define('API_REPORT_GET_REASON_REVENUE_V2', '/order-restaurant-revenue-summary?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_REASON_REVENUE_REPORT
/**
 * Trans: Báo cáo khoản chi
 */
define('API_REPORT_GET_REASON_COST', '/report/order/reason-cost?brand_id=%s&branch_id=%s&type=%s&time=%s'); //api_node.API_GET_REASON_COST_REPORT
define('API_REPORT_GET_REASON_COST_V2', 'api/order-restaurant-profit-debt-amount-summary?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s');
/**
 * Trans: Báo cáo nguyên liệu kho chi nhánh
 */
define('API_REPORT_GET_MATERIAL_BRANCH', '/report/order/material-branch?branch_id=%s&from=%s&to=%s&type=%s'); //api_node.API_GET_MATERIAL_BRANCH_REPORT
define('API_REPORT_GET_MATERIAL_BRANCH_V2', '/order-restaurant-material-by-branch?branch_id=%s&from_date=%s&to_date=%s&material_category_type_parent_id=%s&type=%s'); //api_node.API_GET_MATERIAL_BRANCH_REPORT_V2
/**
 * Trans: Báo cáo nguyên liệu kho nội bộ
 */
define('API_REPORT_GET_MATERIAL_INTERNAL', '/report/order/material-internal?brand_id=%s&branch_id=%s&from=%s&to=%s&type=%s'); //api_node.API_GET_MATERIAL_INTERNAL_REPORT
define('API_REPORT_GET_MATERIAL_INTERNAL_V2', '/order-restaurant-material-by-inner-branch?brand_id=%s&branch_id=%s&from_date=%s&to_date=%s&material_category_type_parent_id=%s&type=%s'); //api_node.API_GET_MATERIAL_INTERNAL_REPORT_V2
/**
 * Trans: Báo cáo kiểm kê kho chi nhánh
 */
define('API_REPORT_GET_INVENTORY_BRANCH', '/report/order/inventory-branch?branch_id=%s&inventory=%s&from_inventory=%s&to_inventory=%s'); //api_node.API_GET_INVENTORY_BRANCH_REPORT
define('API_REPORT_GET_INVENTORY_BRANCH_V2', '/order-restaurant-inventory-report?branch_id=%s&material_category_type_parent_id=%s&from_inventory_report_id=%s&to_inventory_report_id=%s'); //api_node.API_GET_INVENTORY_BRANCH_REPORT
/**
 * Trans: Báo cáo kiểm kê kho nội bộ
 */
//define('API_REPORT_GET_INVENTORY_INTERNAL', '/report/order/inventory-internal?branch_id=%s&inventory=%s&from_inventory=%s&to_inventory=%s');//api_node.API_GET_INVENTORY_INTERNAL_REPORT
define('API_REPORT_GET_INVENTORY_INTERNAL_V2', '/order-restaurant-branch-inventory-report?restaurant_brand_id=%s&branch_id=%s&branch_inner_inventory_type=%s&from_branch_inventory_report_id=%s&to_branch_inventory_report_id=%s'); //api_node.API_GET_INVENTORY_INTERNAL_REPORT
/**
 * Trans: Báo cáo món tặng V1
 */
define('API_REPORT_GET_DETAIL_GIFT_FOOD', '/order-restaurant-order-data-food-gift/order-detail-profit-detail-food-gift?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&food_id=%s&is_gift=%s&is_cancel_food=%s&key_search=%s&from_date=%s&to_date=%s&page=%s&limit=%s'); //api_node.API_GET_GIFT_FOOD_REPORT

/**
 * Trans: Báo cáo món ngoài menu V2
 */
define('API_REPORT_GET_OFF_DISHED_MENU', '/order-restaurant-revenue-by-food?restaurant_brand_id=%s&branch_id=%s&category_types=%s&category_id=%s&food_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s&is_gift=%s&is_combo=%s&is_cancelled_food=%s&is_take_away_food=%s&is_goods=%s'); //api_node.API_GET_PROFIT_FOOD_REPORT
define('API_REPORT_GET_OFF_DISHED_MENU_2', '/order-restaurant-revenue-by-food?restaurant_brand_id=%s&branch_id=%s&category_types=%s&category_id=%s&food_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s&is_gift=%s&is_combo=%s&is_cancelled_food=%s&is_take_away_food=%s&is_goods=%s&type_sort=%s'); //api_node.API_GET_PROFIT_FOOD_REPORT
/**
 * Trans: Báo cáo món huỷ
 */
define('API_REPORT_GET_FOOD_CANCEL', '/order-report-food-cancel?restaurant_brand_id=%s&branch_id=%s&type_sort=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_PROFIT_FOOD_REPORT

/**
 * Trans: Báo cáo lợi nhuận món ăn V2
 */
define('API_REPORT_GET_PROFIT_FOOD', '/order-restaurant-revenue-by-food?restaurant_brand_id=%s&branch_id=%s&category_types=%s&category_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s&is_gift=%s&is_combo=%s&is_cancelled_food=%s&is_take_away_food=%s&is_goods=%s'); //api_node.API_GET_PROFIT_FOOD_REPORT
define('API_REPORT_GET_PROFIT_FOOD_2', '/order-restaurant-revenue-by-food?restaurant_brand_id=%s&branch_id=%s&category_types=%s&category_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s&is_gift=%s&is_combo=%s&is_cancelled_food=%s&is_take_away_food=%s&is_goods=%s&type_sort=%s'); //api_node.API_GET_PROFIT_FOOD_REPORT
/**
 * Trans: Báo cáo doanh thu khu vực V2
 */
define('API_REPORT_GET_AREA', '/order-restaurant-revenue-by-area?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_AREA_REPORT
/**
 * Trans: Báo cáo doanh thu nhân viên
 */
define('API_REPORT_GET_EMPLOYEE', '/report/order/revenue-employee?brand_id=%s&branch_id=%s&type=%s&time=%s'); //api_node.API_GET_EMPLOYEE_REPORT
/**
 * Trans: Báo cáo doanh thu nhân viên V2
 */
define('API_REPORT_GET_EMPLOYEE_V2', '/order-restaurant-revenue-by-employee?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GE
/**
 * Trans: Báo cáo nguyên liệu món ăn V2
 */
define('API_REPORT_GET_MATERIAL_FOOD_V2', '/order-restaurant-material-by-order-detail?branch_id=%s&material_category_type_parent_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_MATERIAL_FOOD_REPORT
/**
 * Trans: Báo cáo kết quả kinh doanh V2
 */
define('API_REPORT_GET_COST_BUSINESS_RESULT', '/order-restaurant-revenue-cost-summary?restaurant_brand_id=%s&branch_id=%s&addition_fee_reason_id=%s&report_type=%s&date_string=%s'); //api_node.API_GET_COST_BUSINESS_RESULT_REPORT
define('API_REPORT_GET_REVENUE_PROFIT_BUSINESS_RESULT', '/order-restaurant-result-business-and-profit?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s'); //api_node.API_GET_REVENUE_PROFIT_BUSINESS_RESULT_REPORT
/**
 * Trans: Báo cáo danh mục món ăn V2
 */
define('API_REPORT_GET_CATEGORY_FOOD', '/order-restaurant-revenue-by-category?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s&category_id=%s&category_type=%s'); //api_node.API_GET_CATEGORY_FOOD_REPORT
define('API_REPORT_GET_CATEGORY_FOOD_2', '/order-restaurant-revenue-by-category?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s&category_id=%s&category_type=%s&type_sort=%s'); //api_node.API_GET_CATEGORY_FOOD_REPORT
/**
 * Trans: Báo cáo món tặng V2
 */
define('API_REPORT_GET_GIFT_FOOD', '/order-report-food-gift?restaurant_brand_id=%s&branch_id=%s&type=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s&type_sort=%s&is_group=%s');//api_node.API_GET_GIFT_FOOD_REPORT
/**
 * Trans: Báo cáo giảm giá V2
 */
define('API_REPORT_GET_DISCOUNT', '/order-restaurant-discount-from-order?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_DISCOUNT_REPORT
/**
 * Trans: Báo cáo món mang về V2
 */
define('API_REPORT_GET_TAKE_AWAY_FOOD_DASHBOARD', '/order-report-food-take-away?restaurant_brand_id=%s&branch_id=%s&is_take_away_food=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s&type_sort=%s'); //api_node.API_GET_TAKE_AWAY_FOOD_REPORT
define('API_REPORT_GET_TAKE_AWAY_FOOD_V2', '/order-report-food-take-away?restaurant_brand_id=%s&branch_id=%s&is_take_away_food=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_TAKE_AWAY_FOOD_REPORT
/**
 * Trans: Báo cáo món hủy V2
 */
define('API_REPORT_GET_CANCEL_FOOD_V2', '/order-report-food-cancel?restaurant_brand_id=%s&branch_id=%s&type=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_CANCEL_FOOD_REPORT
/**
 * Trans: Báo cáo hóa đơn V2
 */
define('API_REPORT_GET_ORDER_V2', '/order-restaurant-order-data?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&page=%s&limit=%s&key_search=%s&from_date=%s&to_date=%s'); //api_node.API_GET_ORDER_REPORT
/**
 * Trans: Báo cáo món ăn V2
 */
define('API_REPORT_GET_FOOD_V2', '/order-report-food?restaurant_brand_id=%s&branch_id=%s&food_id=%s&report_type=%s&date_string=%s&is_goods=%s&is_cancelled_food=%s&is_gift=%s&from_date=%s&to_date=%s'); //api_node.API_GET_FOOD_REPORT
define('API_REPORT_GET_TOTAL_FOOD_V2', '/tms-restaurant-total-revenue-food-by-inventory?brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_TOTAL_FOOD_REPORT
/**
 * Trans: Báo cáo chi tiết tiền mặt V2
 */
define('API_REPORT_GET_CASH_BOOK_V2', '/restaurant-cash-detail-report?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&key_word=%s&page=%s&limit=%s'); //api_node.API_GET_CASH_BOOK_REPORT
/**
 * Trans: Báo cáo chi tiết món ăn, món hủy, món tặng
 */
//define('API_REPORT_GET_DETAIL_FOOD', '/order-restaurant-order-data/order-detail-profit-take-away-detail-food?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&food_id=%s&is_gift=%s&is_cancel_food=%s&page=%s&limit=%s&key_search=%s&from_date=%s&to_date=%s');//api_node.API_GET_DETAIL_FOOD_REPORT
define('API_REPORT_GET_DETAIL_FOOD', '/order-restaurant-order-data-food/order-detail-profit-detail-food?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&food_id=%s&is_gift=%s&is_cancel_food=%s&key_search=%s&from_date=%s&to_date=%s&page=%s&limit=%s'); //api_node.API_GET_DETAIL_FOOD_REPORT
/**
 * Trans: Báo cáo chi tiết Món mang về
 */
define('API_REPORT_GET_DETAIL_TAKE_AWAY', '/order-restaurant-order-data/order-detail-profit-take-away-detail-food?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&food_id=%s&is_gift=%s&is_cancel_food=%s&key_search=%s&from_date=%s&to_date=%s&page=%s&limit=%s'); //api_node.API_GET_DETAIL_FOOD_REPORT
/**
 * Trans: Báo cáo chi tiết Món ngoài menu
 */
define('API_REPORT_GET_DETAIL_OFF_MENU', '/order-restaurant-order-data-food-out-menu?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&food_name=%s&amount=%s&key_search=%s&from_date=%s&to_date=%s&page=%s&limit=%s'); //api_node.API_GET_DETAIL_FOOD_REPORT
/**
 * Trans: Báo cáo chi tiết hóa đơn bán hàng (nhân viên, khu vực, giảm giá, khách hàng)
 */
define('API_REPORT_GET_DETAIL_ORDER_SELL', '/order-restaurant-order-detail-by-area-employee-discount?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&area_id=%s&employee_id=%s&customer_id=%s&is_discount=%s&page=%s&limit=%s&key_search=%s&from_date=%s&to_date=%s'); //api_node.API_GET_DETAIL_ORDER_SELL_REPORT
/**
 * Trans: Báo cáo khách hàng tích điểm
 */
define('API_REPORT_GET_CUSTOMER_ACCUMULATE_POINT', '/report/order/customer-accumulate-point?brand_id=%s&branch_id=%s&type=%s&time=%s&limit=%s'); //api_node.API_GET_CUSTOMER_ACCUMULATE_POINT_REPORT
/**
 * Trans: Báo cáo khách hàng sử dụng điểm
 */
define('API_REPORT_GET_CUSTOMER_USE_POINT', '/customer-use-points-report?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&type_point=%s&from_date=%s&to_date=%s&limit=%s&page=%s&key_search=%s'); //api_node.API_GET_CUSTOMER_USE_POINT_REPORT
/**
 * Trans: Báo cáo khách hàng nạp thẻ
 */
define('API_REPORT_GET_TOP_UP_POINT', '/customer-top-up-point?type_sort=%s&report_type=%s&date_string=%s&type_point=%s&from_date=%s&to_date=%s&limit=%s&page=%s&key_search=%s'); //api_node.API_GET_CUSTOMER_USE_POINT_REPORT
/**
 * Trans: Báo cáo chi tiết Vat
 */
define('API_REPORT_GET_DETAIL_VAT_SELL', '/order-restaurant-order-detail-by-area-employee-vat?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&area_id=%s&employee_id=%s&customer_id=%s&is_vat=%s&page=%s&limit=%s&key_search=%s&from_date=%s&to_date=%s'); //api_node.API_GET_DETAIL_ORDER_SELL_REPORT
/**
 * Báo cáo hoạt động trong ngày thương hiệu
 */
define('API_REPORT_GET_CURRENT_DAY_BRAND_V2', '/order-restaurant-revenue-detail-by-restaurant-brand?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s'); //api_node.API_GET_CURRENT_DAY_BRAND_REPORT
/**
 * Trans: Báo cáo hoạt động trong ngày chi nhánh
 */
define('API_REPORT_GET_CURRENT_DAY_BRANCH_V2', '/order-restaurant-revenue-by-branch?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s'); //api_node.API_GET_CURRENT_DAY_BRANCH_REPORT
/**
 * Trans: Báo cáo các khoản thiền thu tiền chi doanh thu bán hàng khách hàng
 */
define('API_REPORT_GET_CURRENT_DAY_ORDER_V2', '/order-restaurant-revenue-cost-customer-by-branch?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s'); //api_node.API_GET_CURRENT_DAY_ORDER_REPORT
/**
 * Trans: Báo cáo khách hàng v2
 */
define('API_REPORT_GET_CUSTOMER', '/order-customer-report?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_CUSTOMER_REPORT
/**
 * Trans: Báo cáo chi tiết doanh thu bán hàng tổng quan
 */
define('API_REPORT_DETAIL_REVENUE', '/order-overview-report?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_DETAIL_REVENUE
/**
 * Trans: Báo cáo doanh thu v2
 */
define('API_REPORT_GET_REVENUE_CURRENT', '/order-restaurant-revenue-report?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_REVENUE_CURRENT_REPORT
define('API_REPORT_GET_REVENUE_ADJACENT', '/order-restaurant-revenue-report/adjacent?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_REVENUE_ADJACENT_REPORT
define('API_REPORT_GET_REVENUE_SAME_PERIOD', '/order-restaurant-revenue-report/same-period?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_REVENUE_SAME_PERIOD_REPORT
/**
 * Trans: Báo cáo chi phí v2
 */
define('API_REPORT_GET_COST_CURRENT', '/order-restaurant-cost-report?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_COST_CURRENT_REPORT
define('API_REPORT_GET_COST_ADJACENT', '/order-restaurant-cost-report/adjacent?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_COST_ADJACENT_REPORT
define('API_REPORT_GET_COST_SAME_PERIOD', '/order-restaurant-cost-report/same-period?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_COST_SAME_PERIOD_REPORT
/**
 * Trans: Báo cáo lợi nhuận v2
 */
define('API_REPORT_GET_PROFIT_CURRENT', '/order-restaurant-result-business-and-profit?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_PROFIT_CURRENT_REPORT
define('API_REPORT_GET_PROFIT_ADJACENT', '/order-restaurant-result-business-and-profit/adjacent?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_PROFIT_ADJACENT_REPORT
define('API_REPORT_GET_PROFIT_SAME_PERIOD', '/order-restaurant-result-business-and-profit/same-period?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_PROFIT_SAME_PERIOD_REPORT
/**
 * Trans: Báo cáo món tặng tổng quan
 */
define('API_REPORT_GET_GIFT_FOOD_TIME', '/tms-restaurant-summary-food-revenue-by-time?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&is_gift=%s&from_date=%s&to_date=%s'); //api_node.API_GET_GIFT_FOOD_TIME_REPORT
/**
 * Trans: Báo cáo chart phụ thu
 */
define('API_REPORT_GET_SURCHARGE', '/order-restaurant-order-extra-charge?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_SURCHARGE_REPORT
/**
 * Trans: Báo cáo table phụ thu
 */
define('API_REPORT_GET_TABLE_SURCHARGE', '/order-restaurant-order-extra-charge/group-by-id?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s&page=%s&limit=%s'); //api_node.API_GET_SURCHARGE_REPORT
/**
 * Trans: Báo cáo chi tiết phụ thu
 */
define('API_REPORT_GET_DETAIL_SURCHARGE', '/order-restaurant-order-extra-charge/%s/detail?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_SURCHARGE_REPORT
/**
 * Trans: Báo cáo điểm tích luỹ
 */
define('API_REPORT_GET_PROMOTION_POINT', '/order-customer-accumulate-promotion-point?type_point=%s&type_sort=%s&report_type=%s&date_string=%s&key_search=%s&from_date=%s&to_date=%s&page=%s&limit=%s'); //api_node.API_GET_SURCHARGE_REPORT
/**
 * Trans: Báo cáo doanh thu chi phí lợi nhuận
 */
define('API_REPORT_GET_REVENUE_COST_PROFIT', '/report/order/revenue-cost-profit?brand_id=%s&branch_id=%s&type=%s&time=%s'); //api_node.API_GET_REVENUE_COST_PROFIT_REPORT
define('API_REPORT_GET_REVENUE_COST_PROFIT_ESTIMATE', '/report/order/revenue-cost-profit  -estimate?brand_id=%s&branch_id=%s&type=%s&time=%s'); //api_node.API_GET_REVENUE_COST_PROFIT_ESTIMATE_REPORT
define('API_REPORT_GET_REVENUE_COST_PROFIT_REPORT_ALL', '/report/order/revenue-cost-profit-all?brand_id=%s&branch_id=%s&type=%s&time=%s'); //api_node.API_GET_REVENUE_COST_PROFIT_REPORT_ALL
define('API_REPORT_GET_DETAIL_REVENUE', '/order-addition-fee/list-revenue-detail?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&object_type=%s&page=%s&limit=%s&key_search=%s'); //api_node.API_GET_DETAIL_REVENUE_REPORT
define('API_REPORT_GET_DETAIL_COST', '/report/order/detail-cost?brand_id=%s&branch_id=%s&type=%s&time=%s&is_current=%s&page=%s&limit=%s&key_search=%s'); //api_node.API_GET_DETAIL_COST_REPORT
define('API_REPORT_GET_DETAIL_RESTAURANT_ADDITION_REASON_COST', '/order-restaurant-addition-reason-detail-report?restaurant_brand_id=%s&branch_id=%s&type=%s&date_string=%s'); //api_node.API_REPORT_GET_DETAIL_RESTAURANT_ADDITION_REASON_COST
/**
 * Trans: Báo cáo doanh thu chi phí lợi nhuận - v2
 */
define('API_REPORT_GET_REVENUE_COST_PROFIT_ESTIMATE_V2', '/order-restaurant-revenue-cost-profit/estimate?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_REVENUE_COST_PROFIT_ESTIMATE_REPORT
define('API_REPORT_GET_REVENUE_COST_PROFIT_REALITY_V2', '/order-restaurant-revenue-cost-profit/reality?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_REVENUE_COST_PROFIT_ESTIMATE_REPORT
define('API_REPORT_GET_REVENUE_COST_PROFIT_ALL_V2', '/order-restaurant-revenue-cost-profit-synthetic?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_REVENUE_COST_PROFIT_ESTIMATE_REPORT
define('API_REPORT_GET_REVENUE_COST_PROFIT_INVENTORY_INNER', '/warehouse-inner-session-import?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_REVENUE_COST_PROFIT_ESTIMATE_REPORT
/**
 * Trans: Báo cáo công nợ v2
 */
define('API_REPORT_GET_DEBT', '/order-restaurant-debt-report?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s');

/**
 * Trans: Báo cáo P&L
 */
define('API_REPORT_GET_PROFIT_LOSS', '/restaurant-p-and-l-report?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s');
define('API_REPORT_GET_PROFIT_LOSS_TABLE', '/restaurant-p-and-l-report?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s');

/**
 * Trans: Báo cáo P&L
 */
define('API_REPORT_GET_COST_FREIGHT', '/restaurant-c-and-f-report?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s');


/**
 * Trans: Báo cáo công nợ nhà cung cấp v2
 */
define('API_REPORT_GET_SUPPLIER_DEBT', '/order-restaurant-supplier-debts?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s&supplier_ids=%s');
define('API_REPORT_GET_DETAIL_SUPPLIER_DEBT', '/order-restaurant-detail-supplier-debts?restaurant_brand_id=%s&branch_id=%s&supplier_id=%s&report_type=%s&date_string=%s');
/**
 * Trans: Báo cáo lợi nhuận Công ty/Nhà hàng
 */
define('API_REPORT_GET_COMPANY_PROFIT', '/report/order/company-profit?type=%s&time=%s'); //api_node.API_GET_COMPANY_PROFIT_REPORT
define('API_REPORT_GET_COMPANY_PROFIT_V2', 'api/order-restaurant-result-business-and-profit?restaurant_brand_id=%s&type=%s&time=%s'); //api_node.API_GET_COMPANY_PROFIT_REPORT
/**
 * Trans: Báo cáo phân tích chi phí
 */
define('API_REPORT_GET_ANALYSIS_COST', '/report/order/analysis-cost?brand_id=%s&branch_id=%s&type=%s&time=%s&is_get_cost_reality=%s'); //api_node.API_GET_ANALYSIS_COST_REPORT
/**
 * Trans: Báo cáo phân tích chi phí V2
 */
define('API_REPORT_GET_ANALYSIS_COST_V2', '/order-restaurant-profit-debt-amount-summary?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s&is_get_cost_reality=%s'); //api_node.API_GET_ANALYSIS_COST_REPORT
/**
 * Trans: Báo cáo bán hàng
 */
define('API_REPORT_GET_REVENUE_ORDER', '/order-restaurant-revenue-report?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s&from_date=%s&to_date=%s'); //api_node.API_GET_REVENUE_ORDER_REPORT
/**
 * Trans: Báo cáo tăng trưởng kinh doanh
 */
define('API_REPORT_GET_BUSINESS_GROWTH', '/order-restaurant-business-growth-report?restaurant_brand_id=%s&branch_id=%s&report_type=%s&date_string=%s'); //api_node.API_GET_BUSINESS_GROWTH_REPORT
/**
 * Trans: Báo cáo nhập kho
 */
//define('API_REPORT_GET_IN_INVENTORY','/report/order/warehouse-session-branch?brand_id=%s&branch_id=%s&type=%s&time=%s');//api_node.API_GET_IN_INVENTORY_REPORT
//define('API_REPORT_GET_CHECKLIST_GOODS_INTERNAL','/report/order/warehouse-inner-session-inventory?from_inventory_report_id=%s&to_inventory_report_id=%s&material_category_parent_type=%s');//api_node.API_GET_CHECKLIST_GOODS_INTERNAL_REPORT
/**
 * Trans: Card 10
 */
//define('API_REPORT_GET_WAREHOUSE_SESSION', '/reports/warehouse-session-quantity?report_type=%s&branch_id=%s&time=%s');//api.API_GET_WAREHOUSE_SESSION_REPORT
define('API_REPORT_GET_WAREHOUSE_SESSION', '/warehouse-session-import?restaurant_brand_id=%s&branch_id=%s&from_date=%s&to_date=%s&report_type=%s&date_string=%s'); //api.API_GET_WAREHOUSE_SESSION_REPORT

/**
 * Trans: Báo cáo khách hàng mới
 */
define('API_REPORT_GET_NEW_CUSTOMER', '/customers?page=%s&limit=%s&time=%s&report_type=%s'); //api.API_GET_NEW_CUSTOMER_REPORT
define('API_REPORT_GET_CHART_NEW_CUSTOMER', '/new-customer-report?report_type=%s&date_string=%s&from_date=%s&to_date=%s&page=%s&limit=%s'); //api.API_GET_CHART_NEW_CUSTOMER_REPORT
define('API_REPORT_GET_DETAIL_CHART_NEW_CUSTOMER', '/new-customer-report/detail?report_type=%s&date_string=%s&from_date=%s&to_date=%s&page=%s&limit=%s'); //api.API_GET_CHART_NEW_CUSTOMER_REPORT
/**
 * Trans: Báo cáo lịch sử sử dụng điểm
 */
define('API_REPORT_GET_HISTORY_POINT_CUSTOMER', '/customers/point-added-history?type=%s&time=%s'); //api.API_GET_HISTORY_POINT_CUSTOMER_REPORT

/**
 * Trans: Báo cáo bán hàng
 */
define('API_REPORT_GET_SYNTHESIS_DISCOUNT', '/reports/synthesis-report-discount?time=%s&report_type=%s&branch_id=%s'); //api_node.API_GET_DISCOUNT_REPORT
define('API_REPORT_GET_SYNTHESIS_GIFT_FOOD', '/reports/synthesis-report-gift-food?time=%s&report_type=%s&branch_id=%s&limit=%s'); //api_node.API_GET_GIFT_FOOD_REPORT
define('API_REPORT_GET_SYNTHESIS_CUSTOMER', '/reports/synthesis-report-customer?time=%s&report_type=%s&branch_id=%s'); //api_node.API_GET_CUSTOMER_REPORT
define('API_REPORT_GET_REVENUE_RANK_BY_AREA', '/reports/revenue-rank-by-area?type=%s&branch_id=%s&time=%s'); //api_node.API_GET_AREA_REPORT
define('API_REPORT_GET_EMPLOYEE_REVENUE_RANK', '/reports/employees/revenue-rank?type=%s&branch_id=%s&time=%s&limit=%s'); //api_node.API_GET_EMPLOYEE_REPORT
define('API_REPORT_GET_MATERIAL_INVENTORY', '/reports/systhesis-material-quantity-report?type=%s&branch_id=%s&time=%s&material_type=%s'); //api_node.API_GET_MATERIAL_INVENTORY_REPORT
/**
 * Trans: Báo cáo nhập kho nhà cung cấp
 */
define('API_REPORT_GET_INVENTORY_SUPPLIER', '/report/order/supplier-order-detail?branch_id=%s&supplier_id=%s&material_category_type_parent_id=%s&from=%s&to=%s');
define('API_REPORT_GET_INVENTORY_SUPPLIER_V2', '/order-restaurant-material-by-supplier?branch_id=%s&supplier_id=%s&material_category_type_parent_id=%s&key_search=%s&from_date=%s&to_date=%s&type=%s');
/**
 * NOTIFY
 */

define('API_NOTIFY_GET_LIST', '/employee-notification/list-notification?limit=%s&type=%s&position=%s&isViewed=%s'); //api_node.API_GET_LIST_NOTIFY
define('API_NOTIFY_GET_COUNT_NOT_SEEN', '/employee-notification/viewed'); //api_node.API_GET_COUNT_NOT_SEEN_NOTIFY
define('API_NOTIFY_CHAT_GET_COUNT_NOT_SEEN', '/groups/total-unread-message'); //api_node.API_GET_COUNT_NOT_SEEN_NOTIFY_CHAT
define('API_NOTIFY_GET_LIST_VIEW', '/employee-notification/sort?page=%s&limit=%s&type=%s&from=%s&to=%s&is_read=%s&keysearch=%s'); //api_node.API_GET_LIST_NOTIFY_VIEW

/**
 * SETTING
 */

define('API_SETTING_GET_FOLDER_MEDIA_BRANCH', '/api-upload/media/restaurant-category?restaurant_id=%s&branch_id=%s&page=%s&limit=%s&key_search=%s&status=%s&is_public=%s'); //api_node.API_GET_FOLDER_MEDIA_BRANCH
define('API_SETTING_POST_CREATE_FOLDER_MEDIA_BRANCH', '/api-upload/media/restaurant-category'); //api_node.API_POST_CREATE_FOLDER_MEDIA_BRANCH
define('API_SETTING_POST_UPDATE_NAME_FOLDER_MEDIA_BRANCH', '/api-upload/media/update/category-name'); //api_node.API_POST_UPDATE_NAME_FOLDER_MEDIA_BRANCH
define('API_SETTING_POST_REMOVE_FOLDER_MEDIA_BRANCH', '/api-upload/media/remove/restaurant-category/%s'); //api_node.API_POST_REMOVE_FOLDER_MEDIA_BRANCH
define('API_SETTING_GET_MEDIA_BRANCH', '/api-upload/media/list-image?category_id=%s&page=%s&limit=%s&key_search=%s&status=%s'); //api_node.API_GET_MEDIA_BRANCH
define('API_SETTING_POST_UPLOAD_MEDIA_BRANCH', '/api-upload/media/upload-file/%s/%s'); //api_node.API_POST_UPLOAD_MEDIA_BRANCH
define('API_POST_REMOVE_MEDIA_BRANCH', '/api-upload/media/remove-media'); //api_node.API_POST_REMOVE_MEDIA_BRANCH
define('API_POST_UPDATE_MEDIA_BRANCH', '/api-upload/media/update/media-name'); //api_node.API_POST_UPDATE_MEDIA_BRANCH
define('API_POST_SETTING_MEMBER_SHIP_CARD', '/restaurants/%s/setting/is-enable-membership-card'); //api_node.API_POST_UPDATE_MEDIA_BRANCH
define('API_GET_DETAIL_SETTING_MEMBER_SHIP_CARD', '/restaurant-policy-contents'); //api_node.API_POST_UPDATE_MEDIA_BRANCH

/**
 * RESTAURANT PARTNER INVOICE
 */
define('API_RESTAURANT_PARTNER_INVOICE_GET_LIST', '/restaurant-partner-invoice?branch_id=%s&status=%s&partner_electronic_invoice_type=%s&key_search=%s&restaurant_brand_id=%s'); //api.API_PARTNER_INVOICE_GET_LIST
define('API_RESTAURANT_PARTNER_INVOICE_POST_CREATE', '/restaurant-partner-invoice/create'); //api.API_UPDATE_PARTNER_INVOICE
define('API_RESTAURANT_PARTNER_INVOICE_POST_UPDATE', '/restaurant-partner-invoice/%s/update'); //api.API_UPDATE_PARTNER_INVOICE
define('API_RESTAURANT_PARTNER_INVOICE_GET_LIST_PARTNER_INVOICE', '/restaurant-partner-invoice/partner-invoices?type=%s&status=%s'); //api.API_PARTNER_INVOICE_GET_LIST
define('API_RESTAURANT_PARTNER_INVOICE_POST_CHANGE_STATUS ', '/restaurant-partner-invoice/partner-invoices?type=%s&status=%s'); //api.API_PARTNER_INVOICE_GET_LIST
define('API_RESTAURANT_PARTNER_INVOICE_DETAIL', '/restaurant-partner-invoice/%s/detail'); //api.API_RESTAURANT_PARTNER_INVOICE_DETAIL

/**
 * TREASURER (BILL_LIABILITIES)
 */

define('API_BILL_LIABILITIES_GET_LIST', '/supplier-orders/supplier-order-having-order?restaurant_brand_id=%s&branch_id=%s&is_take_all=%s&from_date=%s&to_date=%s'); //api.API_GET_BILL_LIABILITIES
define('API_BILL_LIABILITIES_GET_DETAIL', '/supplier-orders/supplier-order-having-order-detail?supplier_id=%s&restaurant_brand_id=%s&branch_id=%s&from_date=%s&to_date=%s&type=%s&page=%s&limit=%s&search_key=%s'); //api.API_GET_DETAIL_BILL_LIABILITIES
define('API_BILL_LIABILITIES_GET_TAB_DETAIL', '/supplier-orders/tab-count-having-order-detail?supplier_id=%s&branch_id=%s&from_date=%s&to_date=%s&key_search=%s&type_tab=%s'); //api.API_GET_TAB_DETAIL_BILL_LIABILITIES
define('API_BILL_LIABILITIES_POST_RETENTION_MONEY', '/supplier-orders/%s/is-retention-money'); //api.API_POST_RETENTION_MONEY_BILL_LIABILITIES


/**
 * TREASURER (PAYMENT_DEBT)
 */

define('API_SUPPLIER_PAYMENT_GET_DEBT', '/supplier-restaurant-debt-payment-requests?supplier_id=%s&restaurant_brand_id=%s&branch_id=%s&status=%s&from_date=%s&to_date=%s&is_delete=%s&key_search=%s&limit=%s&page=%s'); //api.API_GET_SUPPLIER_PAYMENT_DEBT_TREASURES
define('API_SUPPLIER_PAYMENT_GET_DETAIL_DEBT', '/supplier-restaurant-debt-payment-requests/%s?supplier_id=%s'); //api.API_GET_DETAIL_SUPPLIER_PAYMENT_DEBT_TREASURES
define('API_SUPPLIER_PAYMENT_POST_CHANGE_STATUS_DEBT', '/supplier-restaurant-debt-payment-requests/%s/update'); //api.API_POST_CHANGE_STATUS_SUPPLIER_PAYMENT_DEBT_TREASURES
define('API_SUPPLIER_PAYMENT_GET_LIST_ORDER_BY_LIST_ID_DEBT', '/supplier-orders/by-ids?supplier_order_ids=%s'); //api.API_GET_LIST_ORDER_BY_LIST_ID_SUPPLIER_PAYMENT_DEBT_TREASURES

/**
 * TREASURER (FUND_PERIOD)
 */

define('API_FUND_PERIOD_GET_LIST', '/restaurant-budgets?branch_id=%s'); //api.API_GET_LIST_FUND_PERIOD_TREASURER
define('API_FUND_PERIOD_GET_DETAIL', '/restaurant-budgets/%s/detail?type=%s&page=%s&limit=%s&key_search=%s'); //api.API_GET_DETAIL_FUND_PERIOD_TREASURER
define('API_FUND_PERIOD_GET_TAB_DETAIL', '/restaurant-budgets/%s/total-count-tab?type_tab=%s&key_search=%s'); //api.API_GET_TAB_DETAIL_FUND_PERIOD_TREASURER
define('API_FUND_PERIOD_POST_CONFIRM', '/restaurant-budgets/%s/confirm'); //api.API_POST_CONFIRM_FUND_PERIOD_TREASURER
define('API_FUND_PERIOD_POST_CANCEL', '/restaurant-budgets/%s/cancel'); //api.API_POST_CANCEL_FUND_PERIOD_TREASURER

/**
 * TREASURER (WORK_HISTORY)
 */

define('API_WORK_HISTORY_GET_LIST', '/order-session/end-working-sessions?branch_id=%s&from=%s&to=%s&page=%s'); //api.API_GET_WORK_HISTORY
define('API_WORK_HISTORY_GET_DETAIL', '/order-session/end-working-sessions/%s?branch_id=%s'); //api.API_GET_DETAIL_WORK_HISTORY
define('API_WORK_HISTORY_UPDATE_TIME_KEEPING', '/salary-table/checkin-history/%s?branch_id=%s'); //api.API_UPDATE_TIME_KEEPING
define('API_WORK_HISTORY_CREATE_TIME_KEEPING', '/salary-table/checkin-history/create?branch_id=%s'); //api.API_CREATE_TIME_KEEPING
define('API_WORK_HISTORY_GET_REVENUE_DETAIL', '/order-session/order-history?order_session_id=%s&payment_type=%s'); //api.API_GET_REVENUE_DETAIL_WORK_HISTORY
define('API_WORK_HISTORY_GET_DEPOSIT_DETAIL', '/order-session/deposit-history?order_session_id=%s&type=%s'); //api.API_GET_DEPOSIT_DETAIL_WORK_HISTORY

/**
 * TREASURER (REASON_ADDITION_FEE)
 */

define('API_REASON_ADDITION_FEE_GET_REASON', '/addition-fee-reason?status=%s&is_cost=%s&is_system_auto_generate=%s'); //api.API_GET_REASON_ADDITION_FEE_TREASURER
define('API_REASON_ADDITION_FEE_GET_DATA', '/addition-fees?restaurant_brand_id=%s&branch_id=%s&page=%s&restaurant_budget_id=%s&from=%s&to=%s&type=%s&is_take_auto_generated=%s&order_session_id=%s&employee_id=%s&limit=%s&report_type=%s&auto_generated_type=%s&object_type=%s&addition_fee_reason_id=%s&addition_fee_reason_type_id=%s&addition_fee_statuses=%s&is_count_to_revenue=%s&search_key=%s&payment_method_id=%s&object_id=%s&is_paid_debt=%s&is_restaurant_budget_closed=%s'); //api.API_GET_ADDITION_FEE_TREASURER
define('API_REASON_ADDITION_FEE_POST_CREATE', '/addition-fees/create'); //api.API_POST_CREATE_ADDITION_FEE_TREASURER
define('API_REASON_ADDITION_FEE_POST_UPDATE', '/addition-fees/%s/update'); //api.API_POST_UPDATE_ADDITION_FEE_TREASURER
define('API_REASON_ADDITION_FEE_GET_DETAIL', '/addition-fees/%s?branch_id=%s'); //api.API_GET_DETAIL_ADDITION_FEE
define('API_REASON_ADDITION_FEE_GET_TOTAL_TAB', '/addition-fees/count-tab?branch_id=%s&from_date=%s&to_date=%s&type_tab=%s&key_search=%s&status=%s&is_count_to_revenue=%s'); //api.API_GET_TOTAL_TAB_ADDITION_FEE_TREASURER
define('API_REASON_ADDITION_FEE_POST_CHANGE_STATUS', '/addition-fees/%s/change-status'); //api.API_POST_CHANGE_STATUS_ADDITION_FEE_TREASURER
define('API_REASON_ADDITION_FEE_POST_MULTI_CHANGE_STATUS', '/addition-fees/change-status'); //api.API_POST_CHANGE_STATUS_ADDITION_FEE_TREASURER
define('API_REASON_ADDITION_FEE_GET_SUPPLIER_ORDER', '/supplier-orders/debt-amount?branch_id=%s&supplier_id=%s&is_get_debt_amount=%s&from_date=%s&to_date=%s&page=%s&limit=%s&key_search=%s'); //api.API_GET_SUPPLIER_ORDER_ADDITION_FEE_TREASURER
define('API_REASON_ADDITION_FEE_GET_TOTAL_PAYMENT', '/addition-fees/count-tab-out?branch_id=%s&type_tab=%s&key_search=%s&from_date=%s&to_date=%s&object_type=%s&object_id=%s&addition_fee_reason_id=%s&addition_fee_reason_type_id=%s&is_count_to_revenue=%s&is_paid_debt=%s'); //api.API_GET_TOTAL_PAYMENT_ADDITION_FEE_TREASURER
define('API_REASON_ADDITION_FEE_GET_TOTAL_RECEIPT', '/addition-fees/count-tab-in?branch_id=%s&type_tab=%s&key_search=%s&from_date=%s&to_date=%s&object_type=%s&object_id=%s&addition_fee_reason_id=%s&addition_fee_reason_type_id=%s&automatically_generated_type=%s&is_count_to_revenue=%s&type_tab=%s'); //api.API_GET_TOTAL_RECEIPT_ADDITION_FEE_TREASURER
define('API_ADDITION_REASON_GET_ALL_TYPE', '/addition-fee-reason/types?is_cost=%s&is_system_auto_generate=%s'); //api.API_GET_ADDITION_REASON
define('API_ADDITION_FEE_REASON_POST_CHANGE_STATUS', '/addition-fee-reason/%s/change-status'); //api.API_POST_CHANGE_STATUS_ADDITION_FEE_REASON
define('API_ADDITION_FEE_REASON_POST_RECEIPT_EXPENSES_LIST', '/addition-fee-reason/manage'); //api.API_POST_RECEIPT_EXPENSES_LIST
define('API_ADDITION_FEE_REASON_GET_VAT_CALCULATE', '/orders/%s/vat?branch_id=%s&is_take_cancelled_food=%s&is_print_bill=%s');
define('API_ADDITION_FEE_REASON_LIST_ORDER_GET', '/orders/order-session-closes?restaurant_brand_id=%s&branch_id=%s&page_number=%s&page=%s&order_status=%s&area_id=%s&order_id=%s&table_ids=%s&from_date=%s&to_date=%s&is_apply_vat=%s'); //api.API_GET_LIST_ORDER

/**
 * TREASURER (PAYMENT_BILL)
 */
define('API_PAYMENT_BILL_GET_LIST_FUND', '/restaurant-budgets/time?limit=%s&page=%s');


/**
 * TREASURER (PAYMENT_RECURRING_BILL)
 */

define('API_PAYMENT_RECURRING_BILL_GET_LIST', '/recurring-costs?branch_id=%s&status=%s'); //api.API_GET_PAYMENT_RECURRING_BILL_TREASURER
define('API_PAYMENT_RECURRING_BILL_POST_CREATE', '/recurring-costs'); //api.API_POST_CREATE_PAYMENT_RECURRING_BILL_TREASURER
define('API_PAYMENT_RECURRING_BILL_POST_UPDATE', '/recurring-costs/%s'); //api.API_POST_UPDATE_PAYMENT_RECURRING_BILL_TREASURER
define('API_PAYMENT_RECURRING_BILL_GET_DETAIL', '/recurring-costs/%s?branch_id=%s'); //api.API_GET_DETAIL_PAYMENT_RECURRING_BILL_TREASURER
define('API_PAYMENT_RECURRING_BILL_POST_CHANGE_STATUS', '/recurring-costs/%s/change-status'); //api.API_POST_CHANGE_STATUS_PAYMENT_RECURRING_BILL_TREASURER
define('API_GET_WORK_HISTORY_ADDITION_FEE_GET_DATA', '/order-session/addition-fees?restaurant_brand_id=%s&branch_id=%s&page=%s&restaurant_budget_id=%s&from=&to=&type=%s&is_count_to_revenue=%s&is_take_auto_generated=%s&order_session_id=%s&employee_id=%s&addition_fee_ids=&limit=&search_key='); //api.API_GET_ADDITION_FEE_TREASURER

/**
 * TREASURER (LIST_EMPLOYEE_SALARY_ADDITION)
 */

define('API_LIST_EMPLOYEE_SALARY_ADDITION_GET_LIST_EMPLOYEE_SALARY_ADDITION', '/employee-salary-additions?branch_id=%s&time=%s&types=%s&employee_id=%s&is_punish=%s&status=%s'); //api.API_GET_LIST_EMPLOYEE_SALARY_ADDITION
define('API_LIST_EMPLOYEE_SALARY_ADDITION_POST_EMPLOYEE_BONUS_PUNISH', '/employee-salary-additions/%s'); //api.API_POST_EMPLOYEE_BONUS_PUNISH
define('API_LIST_EMPLOYEE_SALARY_ADDITION_POST_CONFIRM_EMPLOYEE_BONUS_PUNISH', '/employee-salary-additions/%s/confirm'); //api.API_POST_CONFIRM_EMPLOYEE_BONUS_PUNISH
define('API_LIST_EMPLOYEE_SALARY_ADDITION_POST_CANCEL_EMPLOYEE_BONUS_PUNISH', '/employee-salary-additions/%s/cancel'); //api.API_POST_CANCEL_EMPLOYEE_BONUS_PUNISH
define('API_LIST_EMPLOYEE_SALARY_ADDITION_POST_APPROVE_EMPLOYEE_BONUS_PUNISH', '/employee-salary-additions/%s/approve'); //api.API_POST_APPROVE_EMPLOYEE_BONUS_PUNISH
define('API_LIST_EMPLOYEE_SALARY_ADDITION_GET_PROFILE_BY_ID', '/employees/%s'); //api.API_GET_PROFILE_BY_ID
define('API_LIST_EMPLOYEE_SALARY_ADDITION_DETAIL_EMPLOYEE_BONUS_PUNISH', '/employee-salary-additions/%s?branch_id=%s'); //api.API_DETAIL_EMPLOYEE_BONUS_PUNISH
define('API_LIST_EMPLOYEE_SALARY_ADDITION_CREATE_REWARD_BONUS', '/employee-salary-additions/create-multi'); //api.API_CREATE_REWARD_BONUS

/**
 * TREASURER (SALARY_EMPLOYEE)
 */

define('API_SALARY_EMPLOYEE_POST_CONFIRM', '/salary-table/confirm'); //api.API_POST_CONFIRM_SALARY_EMPLOYEE_TREASURER
define('API_SALARY_EMPLOYEE_POST_DENIED', '/salary-table/deny'); //api.API_POST_DENIED_SALARY_EMPLOYEE_TREASURER
define('API_SALARY_EMPLOYEE_GET_ADVANCE', '/employee-salary-additions/addvanced-salary?branch_id=%s&status=%s'); //api.API_GET_ADVANCE_SALARY_EMPLOYEE_TREASURER
define('API_SALARY_EMPLOYEE_POST_CONFIRM_ADVANCE', '/employee-salary-additions/addvanced-salary/%s/pay'); //api.API_POST_CONFIRM_ADVANCE_SALARY_EMPLOYEE_TREASURER
define('API_SALARY_EMPLOYEE_POST_REJECT_ADVANCE', '/employee-salary-additions/addvanced-salary/%s/cancel'); //api.API_POST_REJECT_ADVANCE_SALARY_EMPLOYEE_TREASURER
define('API_GET_DETAIL_ADVANCE_SALARY_EMPLOYEE', '/employee-salary-additions/addvanced-salary/%s'); //api.API_GET_DETAIL_ADVANCE_SALARY

/**
 * TREASURER (CASH_BOOK)
 */

define('API_CASH_BOOK_GET_TIME', '/restaurant-budgets/calculate?branch_id=%s&date=%s&is_count_to_revenue=%s'); //api.API_GET_TIME_CASH_BOOK_TREASURER
define('API_CASH_BOOK_POST_CREATE', '/restaurant-budgets/create'); //api.API_POST_CREATE_CASH_BOOK_TREASURER

/**
 * TREASURER (CASH_FUND)
 */

define('API_CASH_FUND_GET_LIST', '/addition-fees/accumulation?branch_id=%s&time=%s'); //api.API_GET_CASH_FUND

/**
 * FACEBOOK
 */

define('API_FACEBOOK_GET_LIST_PAGES', '/me/accounts?fields=%s&access_token=%s'); // api.API_GET_LIST_PAGES
define('API_FACEBOOK_GET_IMG_PAGE', '/%s/picture?access_token=%s'); // api.API_GET_IMG_PAGE
define('API_FACEBOOK_GET_INFO_PAGES', '/%s?fields=%s&access_token=%s'); // api.API_GET_INFO_PAGES
define('API_FACEBOOK_GET_FEED_PAGE', '/%s/feed?fields=%s&access_token=%s'); //api.API_GET_FEED_PAGE
define('API_FACEBOOK_GET_INFORMATION_USER', '%s?metadata=1&access_token=%s'); //api.API_GET_INFORMATION_USER
/**
 * FACEBOOK MESSAGE
 */

define('API_FACEBOOK_MESSAGE_GET_CONVERSATIONS', '/%s/conversations?fields=%s&access_token=%s&limit=5000'); //api.API_GET_CONVERSATIONS
define('API_FACEBOOK_MESSAGE_POST_SEND_MESSAGE', '/me/messages?access_token=%s'); //api.API_SEND_MESSAGE
define('API_FACEBOOK_MESSAGE_GET_PHOTOS_PAGE', '/%s/albums?fields=%s&access_token=%s'); //api.API_GET_PHOTOS_FANPAGE
define('API_FACEBOOK_MESSAGE_GET_COMMENT_PAGE', '/%s/comments?fields=%s&access_token=%s'); //api.API_GET_COMMENT_FANPAGE


/**
 * SALARY
 */

define('API_SALARY_GET_PUNISH_DETAIL', '/salary-table/punish?branch_id=%s&employee_id=%s&time=%s'); //api.API_GET_PUNISH_DETAIL
define('API_SALARY_GET_POINT_DETAIL', '/salary-table/point-histories?branch_id=%s&employee_id=%s&page=%s&limit=%s&time=%s'); //api.API_GET_POINT_DETAIL
define('API_SALARY_POST_SEND', '/salary-table/send-to-employee'); //api.API_POST_SEND_SALARY
define('API_SALARY_GET_COMMENT_SALARY_MANAGE', '/salary-table/comments?employee_id=%s&date=%s&limit=%s&page=%s'); //API_POST_REPLY_COMMENT_PAYROLL_MANAGE
define('API_SALARY_POST_REPLY_COMMENT_SALARY_MANAGE', '/salary-table/comment'); //api.API_POST_REPLY_COMMENT_SALARY_MANAGE
define('API_SALARY_POST_OWNER_CONFIRM_SALARY_TABLE', '/salary-table/approve'); //api.API_POST_OWNER_CONFIRM_SALARY_TABLE
define('API_SALARY_POST_PAID_SALARY_TABLE', '/salary-table/paid'); //api.API_POST_PAID_SALARY_TABLE
define('API_SALARY_SALARY_TABLE_GET_DATA', '/salary-table?branch_id=%s&time=%s&status=%s&employee_role_ids=%s'); //api.API_GET_SALARY_TABLE
define('API_SALARY_GET_CHECK_IN_DETAILS', '/salary-table/checkin-history?time=%s&branch_id=%s&employee_id=%s&type=%s'); //api.API_GET_CHECK_IN_DETAILS
define('API_SALARY_GET_DEBIT_HISTORY', '/orders/debt-history?page=%s&restaurant_brand_id=%s&branch_id=%s&employee_id=%s&from=%s&to=%s'); //api.API_GET_DEBIT_HISTORY
define('API_SALARY_GET_EMPLOYEE_DETAIL', '/employees/%s/manage'); //api.API_GET_EMPLOYEE_DETAIL

/**
 * Trans: Báo cáo biến động giá món
 */
define('API_REPORT_GET_PRICE_CHANGE_HISTORIES', '/order-supplier-material-price-change-histories?restaurant_brand_id=%s&branch_id=%s&supplier_id=%s&from_date=%s&to_date=%s&page=%s&limit=%s&type=%s&key_search=%s&material_category_type_parent_id=%s'); //api_node.API_GET_BUSINESS_GROWTH_REPORT


/**
 * EMPLOYEE_MONTHLY_INFORMATION
 */

define('API_EMPLOYEE_MONTHLY_INFORMATION_GET_DETAIL', '/employee-monthly-infomations?month=%s'); //api.API_GET_DETAIL_EMPLOYEE_MONTHLY_INFOMATION
define('API_EMPLOYEE_MONTHLY_INFORMATION_GET_UPDATE', '/employee-monthly-infomations/detail?employee_id=%s&month=%s&branch_id=%s'); //api.API_GET_UPDATE_EMPLOYEE_MONTHLY_INFOMATION
define('API_EMPLOYEE_MONTHLY_INFORMATION_POST_UPDATE', '/employee-monthly-infomations/%s/update-basic-salary'); //api.API_POST_UPDATE_EMPLOYEE_MONTHLY_INFOMATION


/**
 * EMPLOYEE
 */
define('API_EMPLOYEE_POST_CREATE', '/groups/add-new-user-created'); //api_node.API_POST_CREATE_EMPLOYEE
define('API_EMPLOYEE_GET_DATA', '/employees?branch_id=%s&status=%s&is_include_restaurant_manager=%s&is_take_myself=%s&restaurant_brand_id=%s'); //api.API_GET_ALL_EMPLOYEE
define('API_EMPLOYEE_POST_UPDATE', '/employees/%s/update'); //api.API_POST_UPDATE_EMPLOYEE
define('API_PROFILE_POST_UPDATE', '/employees/%s/update-profile'); //api.API_POST_UPDATE_EMPLOYEE_NEW
define('API_EMPLOYEE_POST_CREATED', '/employees/create'); //api.API_POST_CREATE_EMPLOYEE
define('API_EMPLOYEE_GET_BILL_EMPLOYEE_DETAIL', '/employees/%s/orders-history?type=%s&time=%s&restaurant_brand_id=%s&branch_id=%s&limit=%s&page=%s'); //api.API_GET_BILL_EMPLOYEE_DETAIL
define('API_EMPLOYEE_POST_QUIT_JOB', '/employees/%s/is-quit-job'); //api.API_POST_IS_QUIT_JOB
define('API_EMPLOYEE_POST_CHANGE_STATUS', '/employees/%s/change-status'); //api.API_POST_EMPLOYEE_OFF
define('API_EMPLOYEE_GET_DATA_NOT_OWNER', '/employees/employees-not-in-role-owner?branch_id=%s'); //api.API_GET_ALL_EMPLOYEE_NO_OWNER
define('API_EMPLOYEE_POST_RESET_PASSWORD', '/employees/%s/reset-password'); //api.API_POST_RESET_EMPLOYEE_MANAGE
define('API_EMPLOYEE_GET_LIST_ACTIVITIES', '/employees/get-list-diligence?month=%s&year=%s&branch_id=%s&status=%s&is_have_diligence=%s'); //api.API_GET_EMPLOYEE_SENIORITY
define('API_ASSIGN_EMPLOYEE_TO_BRANCH', '/restaurant-resource-privilege-maps/assign-employee-to-branch'); //api.API_ASSIGN_EMPLOYEE_TO_BRANCH
define('API_GET_BRANCH_OF_EMPLOYEE_DATA', '/restaurant-resource-privilege-maps?restaurant_brand_id=%s&employee_id=%s'); //api.API_GET_LIST_BRANCH_OF_EMPLOYEE

/**
 * TIME_KEEPING
 */

define('API_TIME_KEEPING', '/salary-table/checkin-history?employee_id=%s&branch_id=%s&time=%s&type=%s'); //api.API_TIME_KEEPING
define('API_GET_EMPLOYEE_TIME_KEEPING', '/employees/by-checkin-history?branch_id=%s&status=%s&is_include_restaurant_manager=%s&time=%s'); //api.API_GET_EMPLOYEE_TIME_KEEPING
define('API_GET_EMPLOYEE_V2', '/employees/get-list-v2?branch_id=%s&status=%s'); //api.API_GET_EMPLOYEE_TIME_KEEPING
define('API_GET_EMPLOYEE_CHECKIN', '/employees/information-employee-checkin-branch?branch_id=%s&status=%s'); //api.API_GET_EMPLOYEE_TIME_KEEPING
define('API_GET_EMPLOYEE_LEAVE_DAY', '/salary-table/detail-checkin-history?employee_id=%s&branch_id=%s&time=%s'); //api.API_GET_EMPLOYEE_LEAVE_DAY

/**
 * Employee off
 */
define('API_EMPLOYEE_OFF_GET_DATA', '/employees/%s/off-day'); //api.API_CRUD_DAY_OFF_EMPLOYEE


/**
 * SUPPLIER
 */

define('API_SUPPLIER_POST_CREATE_MULTI', '/supplier-materials/handbook-multi-create'); //api.API_POST_CREATE_MULTI_SUPPLIER_MANAGE
define('API_SUPPLIER_POST_MAP_MATERIAL_RESTAURANT_MANAGE', '/restaurant-materials/assign-material-to-supplier'); //api.API_POST_MAP_SUPPLIER_MATERIAL_RESTAURANT_MANAGE
define('API_SUPPLIER_POST_MAP_MATERIAL_UN_ASSIGN_RESTAURANT_MANAGE', '/restaurant-materials/unassign-material-to-supplier'); //api.API_POST_MAP_SUPPLIER_MATERIAL_RESTAURANT_MANAGE
define('API_SUPPLIER_GET_MATERIAL', '/supplier-materials?supplier_id=%s'); //api.API_GET_supplier_material_BY_SUPPLIER_MANAGE
define('API_SUPPLIER_GET_MATERIAL_CATEGORIES', '/materials/material-categories'); //api.API_GET_supplier_material_CATEGORIES
define('API_POST_CREATE_SUPPLIER_MATERIAL', '/supplier-materials/handbook-create'); //api.API_GET_supplier_material_CATEGORIES
define('API_SUPPLIER_POST_CHANGE_MATERIAL_STATUS', '/supplier-materials/%s/handbook-change-status'); //api.API_POST_CHANGE_supplier_material_STATUS
define('API_SUPPLIER_GET_MATERIAL_DETAIL', '/supplier-materials/%s'); //api.API_GET_supplier_material_DETAIL
define('API_SUPPLIER_POST_MATERIAL_UPDATE', '/supplier-materials/%s/handbook-update'); //api.API_POST_UPDATE_supplier_material
define('API_SUPPLIER_POST_MATERIAL_BOOK_SUPPLIER_DELETE', '/supplier-materials/%s/handbook-change-status');

define('API_SUPPLIER_DATA_GET_LIABILITIES_DETAIL_IN_INVENTORY', '/suppliers/%s/debt?branch_id=%s&is_liabilities=%s&page=%s&from=%s&to=%s'); //api.API_GET_LIABILITIES_DETAIL_IN_INVENTORY

/**
 * BOOKING
 */

define('API_BOOKING_GET_LIST_TABLE', '/bookings?branch_id=%s&from=%s&to=%s&booking_statuses=%s&is_just_take_having_deposit=%s&is_just_take_waiting_confirm_deposit=%s&limit=%s&page=%s&is_get_all=%s'); //api.API_GET_BOOKING_TABLE_MANAGE
define('API_BOOKING_GET_DETAIL_TABLE_MANAGE', '/bookings/%s'); //api.API_GET_DETAIL_BOOKING_TABLE_MANAGE
define('API_BOOKING_GET_TABLE_MANAGE', '/bookings/tables?area_id=%s&branch_id=%s&booking_id=%s'); //api.API_GET_TABLE_BOOKING_TABLE_MANAGE
define('API_BOOKING_GET_AREA_DATA', '/areas?branch_id=%s&is_take_away=%s&status=%s'); //api.API_GET_AREA_DATA
define('API_BOOKING_POST_SETTING_TABLE_MANAGE', '/branches/%s/setting/booking'); //api.API_POST_SETTING_BOOKING_TABLE_MANAGE
define('API_BOOKING_CREATE_TABLE_MANAGE', '/bookings/create'); //api.API_CREATE_BOOKING_TABLE_MANAGE
define('API_BOOKING_RECEIVE_DEPOSIT_TABLE_MANAGE', '/bookings/%s/receive-deposit'); //api.API_RECEIVE_DEPOSIT_BOOKING_TABLE_MANAGE
define('API_BOOKING_POST_RETURN_DEPOSIT_TABLE_MANAGE', '/bookings/%s/return-deposit'); //api.API_POST_RETURN_DEPOSIT_BOOKING_TABLE_MANAGE
define('API_BOOKING_POST_CANCEL_TABLE_MANAGE', '/bookings/%s/cancel'); //api.API_POST_CANCEL_BOOKING_TABLE_MANAGE
define('API_BOOKING_POST_SETUP_TABLE_MANAGE', '/bookings/%s/set-up'); //api.API_POST_SETUP_BOOKING_TABLE_MANAGE
define('API_BOOKING_SEARCH_CUSTOMER', '/customers/search?name=%s&phone=%s&branch_id=%s'); //api.API_SEARCH_CUSTOMER
define('API_BOOKING_SEARCH_CUSTOMER_ALOLINE', '/customers/list-customer-registered-membership-card?limit=%s&key_search=%s&branch_id=%s&is_only_aloline_customer=%s'); //api.API_SEARCH_CUSTOMER_ALOLINE
define('API_BOOKING_CONFIRM_DEPOSIT_BOOKING_TABLE_MANAGE', '/bookings/%s/confirm-deposit'); //api.API_CONFIRM_DEPOSIT_BOOKING_TABLE_MANAGE
define('API_BOOKING_TOTAL_LIST_BOOKING', '/bookings/total-booking?restaurant_brand_id=%s&branch_id=%s'); //api.API_TOTAL_LIST_BOOKING
define('API_BOOKING_POST_CONFIRM_BOOKING_LIST', '/bookings/%s/confirm'); //api.API_POST_CONFIRM_BOOKING_LIST
define('API_BOOKING_POST_CONFIRM_TABLE_BOOKING_LIST', '/bookings/%s/tables'); //api.API_POST_CONFIRM_TABLE_BOOKING_LIST
define('API_BOOKING_POST_UPDATE_BOOKING_LIST', '/bookings/%s/update'); //api.API_POST_UPDATE_BOOKING_LIST
define('API_BOOKING_GET_BRANCH_BOOKING', '/branches?restaurant_brand_id=%s&status=%s&is_enable_membership_card=%s&is_office=%s'); //api.API_GET_BRANCH_BOOKING
define('API_CUSTOMER_TAGS_POST_ASSIGN', '/restaurant-customer-tags/restaurant-customer-tag-assign-for-customers');
define('API_BOOKING_POST_ASSIGN_FOOD', '/foods/assign-booking');
define('API_BOOKING_POST_ACCEPT_CUSTOMER', '/bookings/%s/start');
define('API_BOOKING_POST_ACCEPT_SETUP_TABLE', '/bookings/%s/set-up');
define('API_BOOKING_GET_LIST_TABLE_MES', '/bookings?branch_id=%s&from=%s&to=%s&booking_statuses=%s&is_just_take_having_deposit=%s&is_just_take_waiting_confirm_deposit=%s&limit=%s&page=%s&is_get_all=%s'); //api.API_GET_BOOKING_TABLE_MANAGE

/**
 * FOOD
 */


define('API_FOOD_GET_ALL_MANAGE', '/foods?status=%s&is_take_away=%s&is_addition=%s&category_type=%s&category_id=%s&restaurant_brand_id=%s&branch_id=%s&is_count_material=%s&page=%s&limit=%s&is_bestseller=%s&is_combo=%s&kitchen_id=%s&is_special_gift=%s&key_Search=%s&is_get_food_contain_addition=%s&restaurant_brand_percentage_alert_original_food_id=%s'); //api.API_GET_ALL_FOOD_MANAGE
define('API_FOOD_GET_ALL_VAT_MANAGE', '/foods?status=%s&is_take_away=%s&is_addition=%s&category_type=%s&category_id=%s&restaurant_brand_id=%s&branch_id=%s&is_count_material=%s&page=%s&limit=%s&is_bestseller=%s&is_combo=%s&kitchen_id=%s&is_special_gift=%s&key_Search=%s&restaurant_vat_config_id=%s'); //api.API_GET_ALL_VAT_FOOD_MANAGE
//define('API_FOOD_GET_ALL_BRANCH_MANAGE', '/foods/branch?status=%s&is_take_away=%s&is_addition=%s&category_type=%s&category_id=%s&restaurant_brand_id=%s&branch_id=%s&is_count_material=%s&limit=%s&is_bestseller=%s&is_combo=%s&kitchen_id=%s&is_special_gift=%s&page=%s&key_Search=%s&is_allow_purchase_by_point=%s&is_temporary_percent=%s&is_promotion_percent=%s&is_sell_by_weight=%s'); //api.API_GET_ALL_FOOD_BRANCH_MANAGE
define('API_FOOD_GET_ALL_BRANCH_MANAGE', '/foods?category_type=%s&branch_id=%s&category_id=%s&is_take_away=%s&is_combo=%s&is_sell_by_weight=%s&is_special_gift=%s&status=%s&is_allow_booking=%s&kitchen_id=%s&is_addition=%s'); //api.API_GET_ALL_FOOD_BRANCH_MANAGE
define('API_FOOD_GET_CATEGORY_MANAGE', '/categories?restaurant_brand_id=%s&status=%s'); //api.API_GET_CATEGORY_FOOD_MANAGE
define('API_FOOD_GET_CATEGORY_MANAGE_FOR_TYPE', '/categories?restaurant_brand_id=%s&status=%s&category_types=%s'); //api.API_GET_CATEGORY_FOOD_MANAGE
define('API_FOOD_GET_UNIT_MANAGE', '/foods/unit'); //api.API_GET_UNIT_FOOD_MANAGE
define('API_FOOD_POST_CREATE_MANAGE', '/foods/create'); //api.API_POST_CREATE_FOOD_MANAGE
define('API_FOOD_GET_DETAIL_MANAGE_BY_ID', '/foods/%s/?branch_id=%s'); //api.API_GET_FOOD_DETAIL_MANAGE_BY_ID
define('API_FOOD_POST_CHANGE_STATUS_MANAGE', '/foods/%s/change-status'); //api.API_POST_FOOD_CHANGE_STATUS_MANAGE,api.API_POST_FOOD_CHANGE_STATUS
define('API_FOOD_POST_CHANGE_STATUS_BRANCH_MANAGE', '/foods/%s/change-status-branch'); //api.API_POST_CHANGE_STATUS_FOOD_BRANCH_MANAGE
define('API_FOOD_POST_UPDATE_MANAGE', '/foods/update'); //api.API_POST_UPDATE_FOOD_MANAGE
define('API_FOOD_GET_COMBO_DETAIL_MANAGE', '/foods/import?food_id=%s&restaurant_brand_id=%s'); //api.API_GET_COMBO_DETAIL_FOOD_MANAGE
define('API_FOOD_POST_UPDATE_COMBO_MANAGE', '/foods/import-food-combo'); //api.API_POST_UPDATE_COMBO_FOOD_MANAGE
define('API_FOOD_POST_CHANGE_KITCHEN_MANAGE', '/foods/kitchen-place'); //api.API_POST_CHANGE_KITCHEN_FOOD_MANAGE
define('API_FOOD_POST_UPDATE_BRANCH', '/foods/%s/update/branch'); //api.API_POST_UPDATE_FOOD_BRANCH
define('API_FOOD_GET_UN_EXIST', '/bookings/%s/update'); //api.API_GET_FOOD_UNEXIST
define('API_FOOD_GET_COUNT_UN_EXIST', '/bookings/%s/update'); //api.API_GET_COUNT_FOOD_UNEXIST
define('API_FOOD_POST_ASSIGN', '/bookings/%s/update'); //api.API_POST_FOOD_ASSIGN
define('API_FOOD_GET_TOTAL', '/foods/count-food?restaurant_brand_id=%s&branch_id=%s'); //api.API_TOTAL_FOOD
define('API_FOOD_NOTE_BRAND_MANAGE', '/food-notes?restaurant_brand_id=%s'); //api.API_FOOD_NOTE_FOOD_BRAND_MANAGE
define('API_FOOD_ASSIGN_NOTE_BRAND_MANAGE', '/food-notes/assign-food-to-food-note'); //api.API_ASSIGN_FOOD_NOTE_FOOD_BRAND_MANAGE
define('API_FOOD_GET_MATERIAL_BRAND_BRAND_MANAGE', '/restaurant-materials/assigned-to-restaurant-brand?restaurant_brand_id=%s&is_just_take_assigned=%s'); //api.API_GET_MATERIAL_BRAND_FOOD_BRAND_MANAGE
define('API_FOOD_GET_VAT_BRAND_MANAGE', '/restaurant-vat-configs?is_actived=%s'); //api.API_GET_VAT_FOOD_BRAND_MANAGE
define('API_FOOD_POST_SETUP_VAT_BRAND_MANAGE', '/foods/assign-vat-for-food'); //api.API_POST_SETUP_VAT_FOOD_BRAND_MANAGE
define('API_FOOD_POST_REMOVE_VAT_BRAND_MANAGE', '/foods/remove-vat-to-food'); //api.API_POST_REMOVE_VAT_FOOD_BRAND_MANAGE

define('API_TAKE_AWAY_BRANCH_POST_ASSIGN_FOOD', '/foods/branch/take-away'); //api.API_POST_ASSIGN_TAKE_AWAY_BRANCH_FOOD
define('API_TAKE_AWAY_FOOD_POST_FOOD_BRAND', '/foods/take-away'); //api.API_POST_FOOD_BRAND_TAKE_AWAY_FOOD
define('API_TAKE_AWAY_FOOD_POST_SETTING', '/branches/%s/setting'); //api.API_POST_SETTING_TAKE_AWAY_FOOD
define('API_TAKE_AWAY_FOOD_POST_SETTING_BRAND', '/restaurant-brands/%s/setting/take-away'); //api.API_POST_SETTING_TAKE_AWAY_FOOD_BRAND

define('API_ASSIGN_BESTSELLING_FOOD_POST_CUSTOMER', '/foods/update-food-bestseller'); //api.API_POST_ASSIGN_BESTSELLING_FOOD_CUSTOMER

define('API_MATERIALS_OF_FOOD_POST_ASSIGN', '/foods/%s/assign-materials'); //api.API_POST_ASSIGN_MATERIALS_OF_FOOD
define('API_MATERIAL_OF_FOOD_GET_DATA', '/foods/%s/material?restaurant_brand_id=%s&'); //api.API_GET_MATERIAL_OF_FOOD

define('API_CATEGORY_FOOD_GET_DATA', '/categories?restaurant_brand_id=%s&status=%s'); //api.API_GET_CATEGORY_FOOD
define('API_CATEGORY_FOOD_POST_CREATE', '/categories/create'); //api.API_POST_CREATE_CATEGORY_FOOD
define('API_CATEGORY_FOOD_POST_UPDATE', '/categories/%s/update'); //api.API_POST_UPDATE_CATEGORY_FOOD
define('API_CATEGORY_FOOD_POST_STATUS', '/categories/%s/change-status'); //api.API_POST_STATUS_CATEGORY_FOOD

define('API_FOOD_UNIT_GET', '/foods/unit'); //api.API_GET_FOOD_UNIT
define('API_FOOD_UNIT_POST_CRUD', '/foods/unit/%s'); //api.API_POST_CRUD_FOOD_UNIT

define('API_GIFT_FOOD_POST_ASSIGN_DATA', '/foods/assign-employee-gift-for-food'); //api.API_POST_ASSIGN_GIFT_FOOD_DATA

define('API_FOOD_NOTE_GET_DATA', '/food-notes?restaurant_brand_id=%s'); //api.API_GET_FOOD_NOTE
define('API_FOOD_NOTE_POST_CREATE', '/food-notes/create'); //api.API_POST_CREATE_FOOD_NOTE
define('API_FOOD_NOTE_POST_UPDATE', '/food-notes/%s/update'); //api.API_POST_UPDATE_FOOD_NOTE
define('API_FOOD_NOTE_POST_CHANGE_STATUS', '/food-notes/change-is-hidden/%s'); //api.API_POST_CHANGE_STATUS_FOOD_NOTE
define('API_FOOD_NOTE_GET_DETAIL', '/food-notes/%s?restaurant_brand_id=%s'); //api.API_GET_DETAIL_FOOD_NOTE
define('API_ASSIGN_FOOD_POST_NOTE', '/food-notes/assign-food-note-to-food'); //api.API_GET_DETAIL_FOOD_NOTE
define('API_FOOD_NOTE_POST_ASSIGN', '/foods/assign-employee-gift-for-food'); //api.API_POST_ASSIGN_FOOD_NOTE

/* WARNING PRICE FOOD */
define('API_WARNING_PRICE_FOOD_GET_FOOD_DATA', '/restaurant-brand-percentage-alert-original-foods?restaurant_brand_id=%s&category_type=%s');
define('API_WARNING_PRICE_FOOD_POST_UPDATE_FOOD_DATA', '/restaurant-brand-percentage-alert-original-foods/%s/update');


define('API_CANCEL_FOOD_GET_REASONS', '/reject-reason?restaurant_brand_id=%s'); //api.API_GET_REASONS_CANCEL_FOOD
define('API_CANCEL_FOOD_POST_CREATE_REASONS', '/reject-reason/create'); //api.API_POST_CREATE_REASONS_CANCEL_FOOD
define('API_CANCEL_FOOD_POST_UPDATE_REASONS', '/reject-reason/%s/update'); //api.API_POST_UPDATE_REASONS_CANCEL_FOOD
define('API_REMOVE_REASONS_POST_CANCEL_FOOD', '/reject-reason/%s/remove'); //api.API_POST_UPDATE_REASONS_CANCEL_FOOD


define('API_QUANTITATIVE_FOOD_POST_IMPORT_EXCEL_MATERIALS', '/foods/import-food-materials'); //api.API_POST_IMPORT_EXCEL_MATERIALS
define('API_QUANTITATIVE_FOOD_POST_CHECK_IMPORT_FOOD_MATERIALS', '/foods/check-import-food-materials'); //api.API_POST_CHECK_IMPORT_FOOD_MATERIALS
define('API_FOOD_UPLOAD_BY_CODE', '/foods/avatar'); //api.API_UPLOAD_FOOD_BY_CODE
define('API_FOOD_GET_DETAIL', '/reports/food-revenue-each-food?branch_id=%s&type=%s&time=%s&food_id=%s'); //api.API_GET_FOOD_DETAIL
define('API_INVENTORY_GET_HISTORY', '/warehouse/inventory-history?branch_id=%s'); //api.API_GET_FOOD_DETAIL
define('API_INVENTORY_GET_MATERIAL_UNIT_FOOD_MAPS', '/material-unit-food-maps?material_unit_id=%s'); //api.API_INVENTORY_GET_MATERIAL_UNIT_FOOD_MAPS
define('API_INVENTORY_GET_MATERIAL_UNIT_FOOD_MAPS2', '/material-unit-food-maps?restaurant_brand_id=%s&material_unit_id=%s&restaurant_material_id=%s&material_unit_specification_exchange_name_id=%s'); //api.API_INVENTORY_GET_MATERIAL_UNIT_FOOD_MAPS
define('API_INVENTORY_GET_MATERIAL_UNIT_ORDER_FOOD', '/material-unit-quantification-material-maps/material/?restaurant_material_id=%s');

/**
 * AREA PRICE
 */

define('API_AREA_PRICE_GET_LIST_FOOD', '/foods/list-food-branch-and-area-map?branch_id=%s&area_id=%s'); //api.API_GET_LIST_FOOD_AREA_PRICE
define('API_AREA_PRICE_POST_UPDATE', '/area-food-maps/update-price-area-food-map'); //api.API_POST_UPDATE_AREA_PRICE

/**
 * SURCHARGE
 */

define('API_SURCHARGE_GET_DATA', '/restaurant-extra-charges?restaurant_brand_id=%s&status=%s'); //api.API_GET_SURCHARGE
define('API_SURCHARGE_POST_CREATE', '/restaurant-extra-charges/create'); //api.API_POST_CREATE_SURCHARGE
define('API_SURCHARGE_POST_CHANGE_STATUS', '/restaurant-extra-charges/%s/change-status'); //api.API_POST_CHANGE_STATUS_SURCHARGE
define('API_SURCHARGE_POST_UPDATE', '/restaurant-extra-charges/%s'); //api.API_POST_UPDATE_SURCHARGE
define('API_SURCHARGE_GET_DETAIL', '/restaurant-extra-charges/%s'); //api.API_GET_DETAIL_SURCHARGE


/**
 * CASH_BOOK_MANAGE
 */

define('API_CASH_BOOK_MANAGE_GET_DATA', '/restaurant-budgets?branch_id=%s&page=%s&limit=%s'); //api.API_GET_LIST_CASH_BOOK_MANAGE
define('API_CASH_BOOK_MANAGE_POST_CONFIRM', '/restaurant-budgets/%s/confirm'); //api.API_POST_CONFIRM_CASH_BOOK_MANAGE
define('API_CASH_BOOK_MANAGE_POST_CANCEL', '/restaurant-budgets/%s/cancel'); //api.API_POST_CANCEL_CASH_BOOK_MANAGE


/**
 * LIST_ORDER
 */

define('API_LIST_ORDER_GET', '/orders?restaurant_brand_id=%s&branch_id=%s&page_number=%s&page=%s&order_status=%s&area_id=%s&order_id=%s&table_ids=%s&is_apply_vat=%s&is_service_restaurant_charge=%s&from_date=%s&to_date=%s&key_search=%s'); //api.API_GET_LIST_ORDER
define('API_LIST_ORDER_GET_DETAIL', '/orders/%s?is_take_cancelled_food=%s&is_print_bill=%s'); //api.API_GET_LIST_ORDER_DETAIL
define('API_LIST_ORDER_GET_TOTAL', '/orders/total-amount?branch_id=%s&order_status=%s&area_id=%s&order_id=%s&table_ids=%s&from_date=%s&to_date=%s&is_force_online=%s&key_search=%s'); //api.API_GET_TOTAL_LIST_ORDER
define('API_LIST_ORDER_GET_HISTORY_BILL_TREASURER', '/logs/activity?object_id=%s&type=%s&page=%s&limit=%s&key_search=%s'); //api.API_GET_HISTORY_BILL_TREASURER

/**
 * INVOICES
 */

define('API_INVOICES_CHECK_BRANCH_HAS_PARTNER', '/restaurant-partner-invoice/branch-has-partner-invoice?branch_id=%s'); //api.API_INVOICES_CHECK_BRANCH_HAS_PARTNER
define('API_INVOICES_GET', '/invoices?page=%s&limit=%s&key_search=%s&cct_duyet=%s&branch_id=%s&invoice_status=%s&from=%s&to=%s'); //api.API_GET_INVOICES
define('API_INVOICES_GET_DETAIL', '/invoices/detail/%s'); //api.API_GET_INVOICES_DETAIL
define('API_INVOICES_POST_CANCEL', '/invoices/cancel/partner'); //api.API_GET_INVOICES_CANCEL
define('API_INVOICES_POST_UPDATE', '/invoices/update/partner'); //api.API_GET_INVOICES_UPDATE
define('API_INVOICES_POST_UPDATE_INFO', '/invoices/update'); //api.API_INVOICES_POST_UPDATE_INFO
define('API_INVOICES_POST_EXPORT', '/invoices/export/partner'); //api.API_GET_INVOICES_EXPORT
define('API_INVOICES_POST_UPDATE_FOODS', '/invoice-details/update-multi'); //api.API_INVOICES_POST_UPDATE_FOODS
define('API_INVOICES_POST_UPDATE_FOODS_DASHBOARD', '/invoice-details/update-multi-dasboard'); //api.API_INVOICES_POST_UPDATE_FOODS_DASHBOARD
define('API_INVOICES_POST_CREATE_FOODS', '/invoice-details/create-multi'); //api.API_INVOICES_POST_CREATE_FOODS
define('API_INVOICES_GET_TOTAL', '/invoices/total-amount?branch_id=%s&order_status=%s&area_id=%s&order_id=%s&table_ids=%s&from_date=%s&to_date=%s&key_search=%s'); //api.API_GET_TOTAL_INVOICES
define('API_INVOICES_GET_COUNT_TAB', '/invoices/count-tab?key_search=%s&branch_id=%s&from=%s&to=%s'); //api.API_INVOICES_GET_COUNT_TAB
define('API_INVOICES_GET_DETAIL_INVOICE', '/invoice-details?invoice_id=%s'); //api.API_INVOICES_GET_DETAIL_INVOICE
define('API_INVOICES_CHANGE_STATUS_FOOD', '/invoice-details/change-status'); //api.API_INVOICES_CHANGE_STATUS_FOOD

/**
 * MEMBERSHIP_CARD
 */
define('API_MEMBERSHIP_CARD_POST_DATA', '/membership-cards'); //api.API_POST_MEMBERSHIP_CARD
define('API_MEMBERSHIP_CARD_GET', '/restaurant-membership-cards'); //api.API_GET_MEMBERSHIP_CARD
define('API_MEMBERSHIP_CARD_GET_DETAIL', '/restaurant-membership-cards/%s'); //api.API_GET_DETAIL_MEMBERSHIP_CARD
define('API_MEMBERSHIP_CARD_GET_TEMPLATE', '/activity-log-object-id?object_id=%s'); //api.API_GET_MEMBERSHIP_CARD_TEMPLATE
define('API_MEMBERSHIP_CARD_POST', '/restaurant-membership-cards'); //api.API_POST_MEMBERSHIP_CARD
define('API_MEMBERSHIP_CARD_POST_UPDATE', '/restaurant-membership-cards/%s'); //api.API_POST_UPDATE_MEMBERSHIP_CARD
define('API_MEMBERSHIP_CARD_POST_CHANGE_STATUS_RESTAURANT', '/restaurants/%s/setting/membership-card'); //api.API_POST_CHANGE_STATUS_RESTAURANT_MEMBERSHIP_CARD
define('API_MEMBERSHIP_CARD_POST_CHANGE_ENABLE_RESTAURANT', '/restaurants/%s/setting/is-enable-membership-card'); //api.API_POST_CHANGE_STATUS_RESTAURANT_MEMBERSHIP_CARD
define('API_MEMBERSHIP_CARD_POST_CHANGE_STATUS_BRANCH', '/branches/%s/setting/membership-card'); //api.API_POST_CHANGE_STATUS_BRANCH_MEMBERSHIP_CARD
define('API_MEMBERSHIP_CARD_POST_CHANGE_STATUS_BRAND', '/restaurant-brands/%s/setting/membership-card'); //api.API_POST_CHANGE_STATUS_BRAND_MEMBERSHIP_CARD
define('API_MEMBERSHIP_CARD_GET_DATA_CONFIG', '/restaurants/%s/maximum-percent-order-amount'); //api.API_GET_DATA_CONFIG_MEMBERSHIP_CARD
define('API_MEMBERSHIP_CARD_POST_DATA_SETTING', '/restaurant-policy-contents/create'); //api.API_POST_DATA_SETTING_MEMBERSHIP_CARD
define('API_MEMBERSHIP_CARD_POST_DATA_CONFIG', '/restaurants/%s/maximum-percent-order-amount'); //api.API_POST_DATA_CONFIG_MEMBERSHIP_CARD

/**
 * BENEFIT_MEMBERSHIP_CARD
 */

define('API_BENEFIT_MEMBERSHIP_CARD_GET_DATA', '/membership-card-prerogatives?membership_card_id=%s&status=%s'); //api.API_GET_BENEFIT_MEMBERSHIP_CARD

/**
 * CUSTOMERS
 */

define('API_CUSTOMERS_GET', '/customers?report_type=%s&is_using_point=%s&page=%s&limit=%s&key_search=%s'); //api.API_GET_CUSTOMERS
define('API_CUSTOMERS_GET_TAB', '/customers/count-tab-customer?type_tab=%s&report_type=%s&key_search=%s'); //api.API_GET_TAB_CUSTOMERS
define('API_CUSTOMERS_GET_DETAIL', '/customers/%s/profile'); //api.API_GET_DETAIL_CUSTOMERS
define('API_CUSTOMERS_GET_ORDER', '/customers/%s/order-history'); //api.API_GET_ORDER_CUSTOMER
define('API_CUSTOMERS_GET_HISTORY_POINT', '/customers/%s/point-history?branch_id=%s&point_type=%s&type=%s&page=%s&limit=%s'); //api.API_GET_HISTORY_POINT_CUSTOMER
define('API_GET_RECHARGE_CARDS_CUSTOMER', '/customers/-1/top-up?branch_id=%s&employee_id=%s&from=%s&to=%s&page=1&limit=100'); //api.API_GET_RECHARGE_CARDS_CUSTOMER
//define('API_CUSTOMERS_GET_RECHARGE_CARDS', '/restaurant-top-up-cards?status=1'); //api.API_GET_RECHARGE_CARDS_CUSTOMER
define('API_CUSTOMERS_GET_RECHARGE_CARDS', '/customers/membership-top-up?branch_id=%s&request_status=%s&is_used=%s&key_search=%s&from=%s&to=%s&limit=%s&page=%s'); //api.API_GET_RECHARGE_CARDS_CUSTOMER
define('API_CUSTOMERS_GET_CARD', '/customers/membership-top-up?restaurant_id=%s&branch_id=%s&page=%s&limit=%s&is_used=%s&from=%s&to=%s'); //api.API_CUSTOMERS_GET_CARD
define('API_CUSTOMERS_CONFIRM_CARD', '/customers/membership-top-up/%s/confirm'); //api.API_CUSTOMERS_CONFIRM_CARD
define('API_CUSTOMERS_CANCEL_CARD', '/customers/membership-top-up/%s/cancel'); //api.API_CUSTOMERS_CANCEL_CARD
define('API_CUSTOMERS_DETAIL_CARD', '/customers/membership-top-up/%s'); //api.API_CUSTOMERS_DETAIL_CARD
define('API_CUSTOMERS_DATA_UPDATE_CARD', '/customers/membership-top-up/%s'); //api.API_CUSTOMERS_DATA_UPDATE_CARD
define('API_CUSTOMERS_UPDATE_CARD', '/customers/membership-top-up/%s/update'); //api.API_CUSTOMERS_UPDATE_CARD

define('API_CARD_GET_VALUE', '/restaurant-top-up-cards?status=%s'); //api.API_GET_CARD_VALUE
define('API_CREATE_CARD_VALUE_POST', '/restaurant-top-up-cards/create'); //api.API_GET_CARD_VALUE
define('API_UPDATE_CARD_VALUE_POST', '/restaurant-top-up-cards/%s'); //api.API_GET_CARD_VALUE
define('API_CHANGE_STATUS_CARD_VALUE_POST', '/restaurant-top-up-cards/%s/change-status'); //api.API_GET_CARD_VALUE
define('API_DETAIL_CARD_VALUE_POST', '/restaurant-top-up-cards/%s'); //api.API_GET_CARD_VALUE

define('API_CREATE_CARDS_POST', '/customers/%s/top-up'); //api.API_GET_CARD_VALUE


/**
 * CREATE_CARDS
 */
define('API_CARDS_POST_CREATE', '/restaurant-top-up-cards');
/**
 * BIRTHDAY_GIFT
 */

define('API_BIRTHDAY_GIFT_GET', '/restaurant-birthday-gifts?status=%s'); //api.API_GET_BIRTHDAY_GIFT
define('API_BIRTHDAY_GIFT_GET_BIRTHDAY_GIFT_ICON', '/get-icons'); //api.API_GET_BIRTHDAY_GIFT_ICON
define('API_BIRTHDAY_GIFT_GET_FOR_UPDATE', '/restaurant-birthday-gifts/%s'); //api.API_GET_BIRTHDAY_GIFT_FOR_UPDATE
define('API_BIRTHDAY_GIFT_POST_UPDATE', '/restaurant-birthday-gifts/%s/update'); //api.API_POST_UPDATE_BIRTHDAY_GIFT
define('API_BIRTHDAY_GIFT_POST_CHANGE_STATUS', '/restaurant-birthday-gifts/%s/change-status'); //api.API_POST_CHANGE_STATUS_BIRTHDAY_GIFT
define('API_BIRTHDAY_GIFT_POST_CREATE', '/restaurant-birthday-gifts/create'); //api.API_POST_CREATE_BIRTHDAY_GIFT

/**
 * CARD TAG
 */

define('API_CARD_TAG_GET', '/restaurant-customer-tags?is_delete=%s'); //api.API_CARD_TAG_GET
define('API_CARD_TAG_GET_TAGS_OF_CUSTOMER', '/restaurant-customer-tags/get-tag-for-customer?customer_id=%s');
define('API_CARD_TAG_POST_CREATE', '/restaurant-customer-tags/create'); //api.API_CARD_TAG_POST_CREATE
define('API_CARD_TAG_POST_UPDATE', '/restaurant-customer-tags/%s/update'); //api.API_CARD_TAG_POST_UPDATE
define('API_CARD_TAG_GET_DETAIL', '/restaurant-customer-tags/%s'); //api.API_CARD_TAG_GET_DETAIL
define('API_CARD_TAG_POST_CHANGE_STATUS', '/restaurant-customer-tags/%s/delete'); //api.API_CARD_TAG_POST_CHANGE_STATUS
define('API_CARD_TAG_GET_ASSIGN_RESTAURANT_CUSTOMER_TAG_FOR_CUSTOMERS', '/restaurant-customer-tags/assign-restaurant-customer-tag-for-customers'); //api.API_CARD_TAG_GET_ASSIGN_RESTAURANT_CUSTOMER_TAG_FOR_CUSTOMERS

/**
 *  GIFT
 */

define('API_GIFT_GET_BIRTHDAY_ITEM', '/restaurant-birthday-gift-items?status=%s'); //api.API_GET_BIRTHDAY_GIFT_ITEM
define('API_GIFT_POST_CREATE', '/restaurant-birthday-gift-items/create'); //api.API_POST_CREATE_GIFT
define('API_GIFT_POST_UPDATE', '/restaurant-birthday-gift-items/%s/update'); //api.API_POST_UPDATE_GIFT
define('API_GIFT_POST_CHANGE_STATUS', '/restaurant-birthday-gift-items/%s/change-status?branch_id=%s'); //api.API_POST_CHANGE_STATUS_GIFT

define('API_GIFT_MARKETING_GET', '/restaurant-gifts?restaurant_brand_id=%s&is_active=%s&limit=%s&page=%s'); //api.API_GET_GIFT_MARKETING
define('API_GIFT_MARKETING_POST_CREATE', '/restaurant-gifts/create'); //api.API_POST_CREATE_GIFT_MARKETING
define('API_GIFT_MARKETING_POST_UPDATE', '/restaurant-gifts/%s/update'); //api.API_POST_UPDATE_GIFT_MARKETING
define('API_GIFT_MARKETING_POST_CHANGE_STATUS', '/restaurant-gifts/%s/active'); //api.API_POST_CHANGE_STATUS_GIFT_MARKETING
define('API_GIFT_MARKETING_GET_DETAIL', '/restaurant-gifts/%s'); //api.API_GET_DETAIL_GIFT_MARKETING

define('API_GIFT_MARKETING_GET_CUSTOMER', '/customer-gifts?restaurant_brand_id=%s'); //api.API_GET_CUSTOMER_GIFT_MARKETING
define('API_GIFT_MARKETING_POST_CREATE_CUSTOMER', '/customer-gifts/create'); //api.API_POST_CREATE_CUSTOMER_GIFT_MARKETING

define('API_GIFT_MARKETING_GET_NEW_CUSTOMER', '/restaurant-register-membership-card-gifts?is_restaurant_gift_maps=%s'); //api.API_GET_NEW_CUSTOMER_GIFT_MARKETING
define('API_GIFT_MARKETING_POST_UPDATE_NEW_CUSTOMER', '/restaurant-register-membership-card-gifts/update'); //api.API_POST_UPDATE_NEW_CUSTOMER_GIFT_MARKETING

define('API_GET_NOTIFY_GIFT_MARKETING', '/restaurant-customer-marketing-notifications?is_sent=%s&restaurant_brand_id=%s'); //api.API_GET_NOTIFY_GIFT_MARKETING
define('API_POST_CREATE_NOTIFY_GIFT_MARKETING', '/restaurant-customer-marketing-notifications/create'); //api.API_POST_CREATE_NOTIFY_GIFT_MARKETING
define('API_POST_SEND_TO_ADMIN_NOTIFY_MARKETING', '/restaurant-customer-marketing-notifications/%s/change-status'); //api.API_POST_CREATE_NOTIFY_GIFT_MARKETING
define('API_POST_UPDATE_NOTIFY_GIFT_MARKETING', '/restaurant-customer-marketing-notifications/%s/update'); //api.API_POST_UPDATE_NOTIFY_GIFT_MARKETING
define('API_POST_SEND_NOTIFY_GIFT_MARKETING', '/restaurant-customer-marketing-notifications/test-notification'); //api.API_POST_SEND_NOTIFY_GIFT_MARKETING
define('API_GET_DETAIL_NOTIFY_SEND_MESSAGE', '/restaurant-customer-marketing-notifications/%s'); //api.API_GET_DETAIL_SEND_NOTIFY_GIFT_MARKETING
define('API_CANCEL_SUBMIT_ADMIN_SEND_MESSAGE', '/restaurant-customer-marketing-notifications/%s/cancel');

/**
 * BANNER
 */

define('API_GET_LIST_BANNER_ADVERTS', '/banner-adverts?type=%s&status=%s&is_running=%s&from_date=%s&to_date=%s&key_search=%s&page=%s&limit=%s');
define('API_GET_BANNER_ADVERTS_COUNT_TAB', '/banner-adverts/count-tab?type=%s&status=%s&is_running=%s&from_date=%s&to_date=%s&key_search=%s');
define('API_POST_CREATE_BANNER_ADVERTISEMENT', '/banner-adverts/create');
define('API_POST_UPDATE_BANNER_ADVERTISEMENT', '/banner-adverts/%s/update');
define('API_GET_DETAIL_BANNER_ADVERTISEMENT', '/banner-adverts/%s');
define('API_POST_CHANGE_STATUS_BANNER_ADVERTISEMENT', '/banner-adverts/%s/change-status');
define('API_POST_DELETE_BANNER_ADVERTISEMENT', '/banner-adverts/%s/delete');
define('API_POST_CHANGE_IS_RUNNING_BANNER_ADVERTISEMENT', '/banner-adverts/%s/is-running');

/**
 * DISPLAY SECONDARY
 */
define('API_GET_GET_LIST_ADVERTS', '/restaurant-private-adverts?restaurant_brand_id=%s&status=%s&media_type=%s&is_sub_monitor=%s'); //api.API_GET_LIST_MEDIA_ADVERT_BRANCH
define('API_POST_CONTENT_CREATE', '/restaurant-brands/%s/setting/sub-monitor-acknowledgements'); //api.API_GET_LIST_MEDIA_ADVERT_BRANCH


/**
 * ASSGIN CUSTOMER
 */
define('API_GET_CUSTOMER_EMPLOYEE_ASSIGN_CUSTOMER', '/customer-employee-maps?restaurant_brand_id=%s&is_assinge=%s&page=%s&limit=%s');
define('API_POST_ASSIGN_CUSTOMER_EMPLOYEE', '/customer-employee-maps/assign-customers-for-employee');


/**
 * RESTAURANT-GREETINGS
 */

define('API_RESTAURANT_GREETINGS_GET', '/restaurant-greetings?restaurant_brand_id=%s&status=%s&type=%s'); //api.API_GET_RESTAURANT_GREETING
define('API_RESTAURANT_GREETINGS_POST_CREATE', '/restaurant-greetings/create'); //api.API_POST_CREATE_RESTAURANT_GREETING
define('API_RESTAURANT_GREETINGS_POST_CHANGE_STATUS', '/restaurant-greetings/%s/change-status'); //api.API_POST_CHANGE_STATUS_RESTAURANT_GREETING
define('API_RESTAURANT_GREETINGS_POST_UPDATE', '/restaurant-greetings/%s/update'); //api.API_POST_UPDATE_RESTAURANT_GREETING
define('API_RESTAURANT_GREETINGS_POST_DELETE', '/restaurant-greetings/%s/deleted'); //api.API_POST_DELETE_RESTAURANT_GREETING
define('API_RESTAURANT_GREETINGS_POST_CHANGE_IS_RUNNING', '/restaurant-greetings/%s/running');

/**
 * ONE_GET_ONE_MARKETING
 */

define('API_ONE_GET_ONE_MARKETING_GET_DATA', '/restaurant-pc-buy-one-get-one?restaurant_brand_id=%s&key_search=%s&from_date=%s&to_date=%s&is_running=%s&is_actived=%s'); //api.API_GET_ONE_GET_ONE_MARKETING
define('API_ONE_GET_ONE_MARKETING_POST_CREATE', '/restaurant-pc-buy-one-get-one/create'); //api.API_POST_CREATE_ONE_GET_ONE_MARKETING
define('API_ONE_GET_ONE_MARKETING_POST_CHANGE_STATUS', '/restaurant-pc-buy-one-get-one/%s/change-active'); //api.API_POST_CHANGE_STATUS_ONE_GET_ONE_MARKETING
define('API_ONE_GET_ONE_MARKETING_POST_CHANGE_RUNNING', '/restaurant-pc-buy-one-get-one/%s/change-running'); //api.API_POST_CHANGE_STATUS_ONE_GET_ONE_MARKETING
define('API_ONE_GET_ONE_MARKETING_POST_ASSiGN_FOOD', '/restaurant-pc-buy-one-get-one/multiple-assign-food-gift-to-food'); //api.API_POST_ASSiGN_FOOD_ONE_GET_ONE_MARKETING
define('API_ONE_GET_ONE_MARKETING_GET_DETAIL_FOOD', '/restaurant-pc-buy-one-get-one/%s'); //api.API_GET_DETAIL_FOOD_ONE_GET_ONE_MARKETING
define('API_ONE_GET_ONE_MARKETING_POST_UPDATE_FOOD', '/restaurant-pc-buy-one-get-one/%s/update'); //api.API_POST_UPDATE_FOOD_ONE_GET_ONE_MARKETING
define('API_ONE_GET_ONE_MARKETING_POST_FOOD_DETAIL_FOOD', '/restaurant-pc-buy-one-get-one/%s/food-detail'); //api.API_POST_FOOD_DETAIL_FOOD_ONE_GET_ONE_MARKETING
define('API_ONE_GET_ONE_MARKETING_POST_REMOVE_FOOD_DETAIL_FOOD', '/restaurant-pc-buy-one-get-one/remove-assign-food-restaurant-pc-buy-one-get-one'); //api.API_POST_REMOVE_FOOD_DETAIL_FOOD_ONE_GET_ONE_MARKETING

/**
 * MARKETING_NOTIFICATIONS
 */

define('API_RESTAURANT_CUSTOMER_MARKETING_NOTIFICATIONS_GET_DATA', '/restaurant-customer-marketing-notifications?is_sent=%s'); //api.API_GET_RESTAURANT_CUSTOMER_MARKETING_NOTIFICATIONS
define('API_RESTAURANT_CUSTOMER_MARKETING_NOTIFICATIONS_POST_CREATE', '/restaurant-customer-marketing-notifications/create'); //api.API_POST_CREATE_RESTAURANT_CUSTOMER_MARKETING_NOTIFICATIONS
define('API_RESTAURANT_CUSTOMER_MARKETING_NOTIFICATIONS_POST_UPDATE', '/restaurant-customer-marketing-notifications/%s/update'); //api.API_POST_UPDATE_RESTAURANT_CUSTOMER_MARKETING_NOTIFICATIONS
define('API_RESTAURANT_CUSTOMER_MARKETING_NOTIFICATIONS_POST_SEND', '/restaurant-customer-marketing-notifications/%s/send'); //api.API_POST_SEND_RESTAURANT_CUSTOMER_MARKETING_NOTIFICATIONS
define('API_RESTAURANT_CUSTOMER_MARKETING_NOTIFICATIONS_CHANGE_STATUS', '/restaurant-customer-marketing-notifications/%s/change-status');
/**
 * MARKETING
 */

define('API_MARKETING_POST_CHANGE_IS_RUNNING', '/restaurant-private-adverts/%s/is-running'); //api.API_POST_CHANGE_IS_RUNNING
define('API_MARKETING_POST_CANCEL', '/restaurant-private-adverts/%s/delete'); //api.API_POST_CANCEL_MARKETING
define('API_MARKETING_GET_LIST_MEDIA_ADVERT_BRANCH', '/restaurant-private-adverts?restaurant_brand_id=%s&status=%s&media_type=%s'); //api.API_GET_LIST_MEDIA_ADVERT_BRANCH
define('API_MARKETING_GET_LIST_MEDIA_ADVERT_CHANGE_STATUS', '/restaurant-brands/%s/setting/is-enable-sub-monitor'); //api.API_GET_LIST_MEDIA_ADVERT_BRANCH
define('API_MARKETING_POST_BANNER_TO_ALOLINE', '/restaurant-private-adverts/%s/update'); //api.API_MARKETING_POST_BANNER_TO_ALOLINE


/**
 * MARKETING BEER STORE
 */

define('API_MARKETING_BEER_POST_UPDATE_CONFIG', '/restaurant-pc-beer-gift/%s/update-configs');
define('API_MARKETING_BEER_GET_CONFIG', '/restaurant-pc-beer-gift/%s/detail-config');
define('API_MARKETING_BEER_GET_DETAIL', '/restaurant-pc-beer-gift/%s/detail');
define('API_MARKETING_BEER_GET_MATERIAL', '/restaurant-materials?status=%s&category_id=%s');
define('API_MARKETING_BEER_POST_UPDATE_DETAIL_MATERIAL', '/restaurant-pc-beer-gift/%s/update');
define('API_MARKETING_BEER_POST_RUNNING', '/restaurant-pc-beer-gift/%s/running');


/**
 * PROMOTION
 */

define('API_PROMOTION_GET_DATA', '/restaurant-promotions?restaurant_brand_id=%s&branch_id=%s&status=%s&limit=%s&page=%s&from_date=%s&to_date=%s&key_search=%s'); //api.API_GET_PROMOTION
define('API_PROMOTION_POST_CREATE', '/restaurant-promotions/create'); //api.API_POST_CREATE_PROMOTION
define('API_PROMOTION_POST_UPDATE', '/restaurant-promotions/%s'); //api.API_POST_UPDATE_PROMOTION
define('API_PROMOTION_GET_DETAIL', '/restaurant-promotions/%s'); //api.API_GET_DETAIL_PROMOTION
define('API_PROMOTION_GET_PROMOTION_VOUCHERS', '/restaurant-promotions/%s/vouchres'); //api.API_GET_PROMOTION_VOUCHERS
define('API_PROMOTION_POST_APPLY', '/restaurant-promotions/%s/applying'); //api.API_POST_APPLY_PROMOTION
define('API_PROMOTION_POST_PAUSE', '/restaurant-promotions/%s/pausing'); //api.API_POST_PAUSE_PROMOTION
define('API_PROMOTION_POST_CANCEL', '/restaurant-promotions/%s/canceled'); //api.API_POST_CANCEL_PROMOTION
define('API_PROMOTION_POST_CHANGE_STATUS', '/restaurant-promotions/%s/change-status'); //api.API_POST_CHANGE_STATUS_PROMOTION
define('API_PROMOTION_POST_ASSIGN_FOOD', '/foods/assign-promotion'); //api.API_POST_ASSIGN_FOOD_PROMOTION


define('API_HAPPY_HOUR_GET_DATA', '/restaurant-pc-customer-registers?restaurant_brand_id=%s&promotion_campaign_id=%s&restaurant_object_promotion_campaign_id=%s&restaurant_voucher_id=%s&customer_id=%s&from_date=%s&to_date=%s&is_registed=%s&key_search=%s'); //api.API_GET_LIST_HAPPY_HOUR
define('API_HAPPY_HOUR_POST_UPDATE_HAPPY_HOUR', '/restaurant-leads/%s/update-call'); //api.API_POST_UPDATE_HAPPY_HOUR
define('API_HAPPY_HOUR_POST_CREATE_HAPPY_HOUR', '/restaurant-pc-three/%s/create-restaurant-voucher'); //api.API_POST_CREATE_HAPPY_HOUR
define('API_HAPPY_HOUR_POST_GIFT_HAPPY_HOUR', '/restaurant-pc-three/%s/assign-voucher-to-customer'); //api.API_POST_GIFT_HAPPY_HOUR
define('API_HAPPY_HOUR_GET_GIFT_HAPPY_HOUR', '/restaurant-vouchers?restaurant_brand_id=%s&restaurant_object_promotion_campaign_id=%s'); //api.API_GET_GIFT_HAPPY_HOUR


/**
 * VOUCHER_PROMOTION
 */

define('API_VOUCHER_PROMOTION_GET_DATA', '/restaurant-promotion-campaigns'); //api.API_GET_VOUCHER_PROMOTION
define('API_VOUCHER_PROMOTION_POST_CREATE', '/restaurant-promotion-campaigns/create'); //api.API_POST_CREATE_VOUCHER_PROMOTION
define('API_VOUCHER_PROMOTION_POST_UPDATE', '/restaurant-promotion-campaigns/%s/update'); //api.API_POST_UPDATE_VOUCHER_PROMOTION
define('API_VOUCHER_PROMOTION_POST_CHANGE_STATUS', '/restaurant-promotion-campaigns/%s/is-active'); //api.API_POST_CHANGE_STATUS_VOUCHER_PROMOTION

/**
 * BUILD DATA (TABLE)
 */

define('API_TABLE_POST_MANAGE', '/tables/manage'); //api.API_POST_MANAGE_TABLE
define('API_TABLE_POST_CHANGE_STATUS', '/tables/%s/change-status'); //api.API_POST_MANAGE_TABLE
define('API_TABLE_GET_DATA', '/tables/?branch_id=%s&area_id=%s&status=%s'); //api.API_GET_ALL_TABLES


/**
 * BUILD DATA (AREA)
 */

define('API_GET_ALL_AREA', '/areas?status=%s&branch_id=%s'); //api.API_GET_ALL_AREA
define('API_MANGE_AREA', '/areas/manage'); //api.API_MANAGE_AREA
define('API_MANGE_AREA_CHANGE_STATUS', '/areas/%s/change-status'); //api.API_MANAGE_CHANGE_STATUS


/**
 * BUILD DATA (PRICE_BY_AREA)
 */

define('API_PRICE_BY_AREA_GET_LIST_FOOD', '/area-food-maps?food_id=%s&branch_id=%s&area_id=%s'); //api.API_GET_LIST_FOOD_PRICE_BY_AREA
define('API_PRICE_BY_AREA_GET_LIST_ALL_FOOD', '/foods/list-food-branch-and-area-map?branch_id=%s&area_id=%s'); //api.API_GET_LIST_ALL_FOOD_PRICE_BY_AREA
define('API_PRICE_BY_AREA_POST_UPDATE_PRICE', '/area-food-maps/assign-list-area-to-food'); //api.API_POST_UPDATE_PRICE_AREA_BY_FOOD
define('API_PRICE_BY_AREA_POST_ASSIGN', '/area-food-maps/assign-area-food-map'); //api.API_POST_ASSIGN_PRICE_BY_AREA
define('API_PRICE_BY_AREA_POST_UPDATE', '/area-food-maps/update-price-area-food-map'); //api.API_POST_UPDATE_PRICE_BY_AREA

/**
 * BUILD DATA (SUPPLIER DATA OF RESTAURANT)
 */

define('API_SUPPLIER_DATA_OF_RESTAURANT_GET_DATA', '/restaurant-suppliers?status=%s&branch_id=%s'); //api.API_GET_SUPPLIER_DATA_OF_RESTAURANT
define('API_SUPPLIER_DATA_OF_RESTAURANT_GET_DETAIL', '/restaurant-suppliers/%s'); //api.API_GET_DETAIL_SUPPLIER_DATA_OF_RESTAURANT
define('API_SUPPLIER_DATA_OF_RESTAURANT_POST_CREATE', '/restaurant-suppliers/%s'); //api.API_POST_CREATE_SUPPLIER_OF_RESTAURANT
define('API_SUPPLIER_DATA_OF_RESTAURANT_POST_CHANGE_STATUS', '/restaurant-suppliers/%s/change-status'); //api.API_POST_CHANGE_STATUS_SUPPLIER_DATA_OF_RESTAURANT
define('API_SUPPLIER_DATA_OF_RESTAURANT_GET_DETAIL_ALL', '/suppliers/%s/detail-total-amount?restaurant_brand_id=%s&branch_id=%s'); //api.API_GET_DETAIL_ALL_SUPPLIER
define('API_SUPPLIER_DATA_OF_RESTAURANT_GET_MATERIAL_ALL', '/supplier-materials/detail?supplier_id=%s&restaurant_brand_id=%s&branch_id=%s'); //api.API_GET_MATERIAL_ALL_SUPPLIER
define('API_SUPPLIER_DATA_OF_RESTAURANT_GET_LIST_CONTACT', '/supplier-contacts?supplier_id=%s&status=%s'); //api.API_GET_LIST_CONTACT_SUPPLIER
define('API_SUPPLIER_DATA_OF_RESTAURANT_GET_ROLE', '/supplier-roles?status=%s'); //api.API_GET_ROLE_SUPPLIER
define('API_SUPPLIER_DATA_OF_RESTAURANT_POST_CREATE_CONTACT', '/supplier-contacts/create'); //api.API_POST_CREATE_CONTACT_SUPPLIER
define('API_SUPPLIER_DATA_OF_RESTAURANT_GET_DETAIL_UPDATE_CONTACT', '/supplier-contacts/%s'); //api.API_GET_DETAIL_UPDATE_CONTACT_SUPPLIER
define('API_SUPPLIER_DATA_OF_RESTAURANT_POST_CHANGE_STATUS_CONTACT', '/supplier-contacts/%s/status'); //api.API_POST_CHANGE_STATUS_CONTACT_SUPPLIER
define('API_SUPPLIER_DATA_OF_RESTAURANT_POST_UPDATE_CONTACT', '/supplier-contacts/%s/update'); //api.API_POST_UPDATE_CONTACT_SUPPLIER

/**
 * Trans: Nhà cung cấp hệ thống & sổ tay
 */

define('API_SUPPLIER_GET_ALL_SUPPLIER', '/suppliers?is_take_my_supplier=%s&is_restaurant_supplier=%s&is_exclude_unassign_system_supplier=%s&page=%s&limit=%s&status=%s'); //api.API_GET_ALL_SUPPLIER
define('API_SUPPLIER_POST_ASSIGN_TO_RESTAURANT', '/suppliers/assign-to-restaurant'); //api.API_POST_ASSIGN_SUPPLIER_TO_RESTAURANT
define('API_SUPPLIER_POST_UN_ASSIGN_TO_RESTAURANT', '/suppliers/unassign-to-restaurant'); //api.API_POST_UN_ASSIGN_SUPPLIER_TO_RESTAURANT
define('API_SUPPLIER_GET_ASSIGNED_TO_RESTAURANT_BRAND', '/suppliers/assigned-to-restaurant-brand?restaurant_brand_id=%s&is_restaurant_supplier=%s&page=%s&limit=%s'); //api.API_GET_SUPPLIER_ASSIGNED_TO_RESTAURANT_BRAND
define('API_SUPPLIER_POST_ASSIGN_TO_RESTAURANT_BRAND', '/suppliers/assign-to-restaurant-brand'); //api.API_POST_ASSIGN_SUPPLIER_TO_RESTAURANT_BRAND
define('API_SUPPLIER_POST_UN_ASSIGN_TO_RESTAURANT_BRAND', '/suppliers/unassign-to-restaurant-brand'); //api.API_POST_UN_ASSIGN_SUPPLIER_TO_RESTAURANT_BRAND
define('API_SUPPLIER_GET_ASSIGNED_TO_BRANCH', '/suppliers/assigned-to-branch?branch_id=%s&is_restaurant_supplier=%s&page=%s&limit=%s'); //api.API_GET_SUPPLIER_ASSIGNED_TO_BRANCH
define('API_SUPPLIER_POST_ASSIGN_TO_RESTAURANT_BRANCH', '/suppliers/assign-to-branch'); //api.API_POST_ASSIGN_SUPPLIER_TO_RESTAURANT_BRANCH
define('API_SUPPLIER_POST_ASSIGN_TO_RESTAURANT_BRANCHES', '/suppliers/assign-from-restaurant-brand-to-branch'); //api.API_POST_ASSIGN_SUPPLIER_TO_RESTAURANT_BRANCHES

/**
 * BUILD DATA (LEVEL)
 */

define('API_LEVEL_GET_DATA', '/employees/get-all-rank?restaurant_brand_id=%s&role_id=%s'); //api.API_GET_LEVEL_DATA
define('API_LEVEL_POST_DATA', '/employee-ranks/manage'); //api.API_POST_LEVEL_DATA

/**
 * BUILD DATA (POINT_DATA)
 */

define('API_SALARY_TARGETS_GET_DATA', '/salary-targets?employee_role_id=%s'); //api.API_GET_POINT_DATA
define('API_REMOVE_POINT_POST_DATA', '/salary-targets/change-is-active/%s'); //api.API_GET_POINT_DATA
define('API_SALARY_TARGETS_POST_MANAGE_POINT', '/salary-targets/manage'); //api.API_MANAGE_POINT

/**
 * BUILD DATA (BOOKING BONUS)
 */

define('API_BOOKING_BONUS_GET', '/restaurant-booking-bonus-levels?id=%s&restaurant_brand_id=%s&is_hidden=%s'); //api.API_GET_BOOKING_BONUS_DATA
define('API_BOOKING_BONUS_POST_CREATE', '/restaurant-booking-bonus-levels/create'); //api.API_POST_CREATE_BOOKING_BONUS_DATA
define('API_BOOKING_BONUS_POST_UPDATE', '/restaurant-booking-bonus-levels/%s/update'); //api.API_POST_UPDATE_BOOKING_BONUS_DATA
define('API_BOOKING_BONUS_POST_CHANGE_STATUS', '/restaurant-booking-bonus-levels/change-is-applied/%s'); //api.API_POST_CHANGE_STATUS_BOOKING_BONUS_DATA
define('API_CHANGE_BOOKING_BONUS_POST_DATA_EMPLOYEE', '/restaurant-brands/%s/setting/bonus-booking'); //

/**
 * BUILD DATA (KAI_ZEN)
 */

define('API_GET_KAI_ZEN_BONUS_DATA', '/restaurant-kaizen-bonus-levels'); //api.API_GET_KAIZEN_BONUS_DATA
define('API_POST_CREATE_KAI_ZEN_BONUS_DATA', '/restaurant-kaizen-bonus-levels/create'); //api.API_POST_CREATE_KAIZEN_BONUS_DATA
define('API_POST_UPDATE_KAI_ZEN_BONUS_DATA', '/restaurant-kaizen-bonus-levels/update'); //api.API_POST_UPDATE_KAIZEN_BONUS_DATA

/**
 * BUILD DATA (CATEGORY_WORK)
 */

define('API_CATEGORY_WORK_GET_DATA', '/employee-job-category?employee_role_id=%s&restaurant_brand_id=%s&status=%s'); //api.API_GET_CATEGORY_WORK_DATA
define('API_CATEGORY_WORK_POST_CREATE', '/employee-job-category/create'); //api.API_POST_CREATE_CATEGORY_WORK_DATA
define('API_CATEGORY_WORK_POST_UPDATE', '/employee-job-category/%s/update'); //api.API_POST_UPDATE_CATEGORY_WORK_DATA
define('API_CATEGORY_WORK_POST_SORT', '/employee-job-category/sort'); //api.API_POST_SORT_CATEGORY_WORK_DATA

/**
 * BUILD DATA (WORK_DATA)
 */

define('API_WORK_DATA_GET', '/employee-jobs?restaurant_brand_id=%s&employee_job_category_id=%s&employee_role_id=%s&is_deleted=%s&page=%s&limit=%'); //api.API_GET_WORK_DATA
define('API_WORK_DATA_POST_SORT', '/employee-jobs/sort'); //api.API_POST_SORT_WORK_DATA
define('API_WORK_DATA_POST_MANAGE', '/employee-jobs/create'); //api.API_POST_MANAGE_WORK_DATA
define('API_WORK_DATA_POST_MANAGE_UPDATE', '/employee-jobs/%s/update'); //api.API_POST_MANAGE_WORK_DATA_UPDATE

/**
 * BUILD DATA (UNIT)
 */

define('API_MATERIAL_UNIT_GET_DATA', '/material-units?status=%s'); //api.API_GET_MATERIAL_UNIT
define('API_MATERIAL_UNIT_POST_CREATE', '/material-units/%s'); //api.API_POST_MATERIAL_UNIT
define('API_MATERIAL_UNIT_POST_STATUS', '/material-units/%s/change-status'); //api.API_POST_STATUS_MATERIAL_UNIT

/**
 * UNIT ORDER
 */

define('API_MATERIAL_UNIT_ORDER_GET_DATA', '/material-unit-quantifications');
define('API_MATERIAL_UNIT_ORDER_POST_CREATE', '/material-unit-quantifications/create');
define('API_MATERIAL_UNIT_ORDER_POST_UPDATE', '/material-unit-quantifications/%s/update');
define('API_MATERIAL_UNIT_ORDER_POST_DELETE', '/material-unit-quantifications/%s/delete');
define('API_MATERIAL_UNIT_ORDER_GET_MATERIAL', '/material-unit-quantifications/%s/detail');

/**
 * BUILD DATA (MATERIAL_SPECIFICATIONS)
 */

define('API_MATERIAL_SPECIFICATIONS_GET_DATA', '/material-unit-specifications?status=%s&material_unit_id=%s'); //api.API_GET_MATERIAL_SPECIFICATIONS
define('API_MATERIAL_SPECIFICATIONS_POST_CREATE', '/material-unit-specifications/%s'); //api.API_POST_MATERIAL_SPECIFICATIONS
define('API_MATERIAL_SPECIFICATIONS_POST_STATUS', '/material-unit-specifications/%s/change-status'); //api.API_POST_STATUS_MATERIAL_SPECIFICATIONS
define('API_MATERIAL_SPECIFICATIONS_GET_DATA_SERVER', '/material-unit-specifications/names'); //api.API_GET_DATA_SPECIFICATIONS_SERVER


/**
 * MATERIAL
 */

define('API_MATERIAL_GET_CATEGORY', '/materials/material-categories?status=%s'); //api.API_GET_CATEGORY
define('API_MATERIAL_GET_RESTAURANT', '/restaurant-materials/assigned-to-supplier?supplier_id=%s&page=%s&limit=%s'); //api.API_GET_MATERIAL_RESTAURANT
define('API_MATERIAL_GET_SUPPLIER_MAP_IN_RESTAURANT', '/suppliers/%s/restaurant-materials'); //api.API_GET_SUPPLIER_MATERIAL_MAP_IN_RESTAURANT
define('API_MATERIAL_GET_SUPPLIER_MAP_IN_BRAND', '/restaurant-materials/assigned-to-restaurant-brand?restaurant_brand_id=%s&is_just_take_assigned=%s'); //api.API_GET_supplier_material_MAP_IN_BRAND
define('API_MATERIAL_GET_SUPPLIER_MAP_IN_BRANCH', '/restaurant-materials/assigned-to-branch?branch_id=%s&is_just_take_assigned=%s'); //api.API_GET_supplier_material_MAP_IN_BRANCH
define('API_MATERIAL_GET_BRANCH', '/restaurant-materials/assigned-to-branch?branch_id=%s&status=%s&is_just_take_assigned=%s'); //api.API_GET_MATERIAL_BRANCH
define('API_MATERIAL_POST_DATA', '/restaurant-materials/%s'); //api.API_POST_MATERIAL_DATA,api.API_GET_DATA_MATERIAL_DETAIL_RESTAURANT
define('API_MATERIAL_POST_MAP_DATA_ASSIGN_TO_BRAND', '/restaurant-materials/assign-to-restaurant-brand'); //api.API_POST_MATERIAL_MAP_DATA_ASSIGN_TO_BRAND
define('API_MATERIAL_POST_MAP_DATA_UN_ASSIGN_TO_BRAND', '/restaurant-materials/unassign-to-restaurant-brand'); //api.API_POST_MATERIAL_MAP_DATA_ASSIGN_TO_BRAND
define('API_MATERIAL_POST_MAP_DATA_ASSIGN_TO_BRANCH', '/restaurant-materials/assign-to-branch'); //api.API_POST_MATERIAL_MAP_DATA_ASSIGN_TO_BRANCH
define('API_MATERIAL_POST_CHANGE_STATUS_RESTAURANT', '/restaurant-materials/%s/change-status?is_confirmed=%s'); //api.API_POST_CHANGE_STATUS_MATERIAL_RESTAURANT
define('API_MATERIAL_POST_CHECK_MATERIAL_RESTAURANT', '/restaurant-materials/%s/change-status'); //api.API_POST_CHANGE_STATUS_MATERIAL_RESTAURANT
define('API_MATERIAL_GET_QUANTITY', '/reports/material-quantity-by-inventory-sesion?branch_id=%s&from_inventory_id=%s&to_inventory_id=%s'); //api.API_GET_MATERIAL_QUANTITY_REPORT
define('API_MATERIAL_GET_LIST_RESTAURANT', '/supplier-materials?supplier_id=%s&status=%s'); //api.API_GET_LIST_MATERIAL_RESTAURANT
//define('API_MATERIAL_GET_LIST_RESTAURANT', '/supplier-materials?supplier_id=%s&status=%s'); //api.API_GET_LIST_MATERIAL_RESTAURANT
define('API_MATERIAL_GET_LIST_RESTAURANT_2', '/restaurant-materials?supplier_id=%s&status=%s'); //api.API_GET_LIST_MATERIAL_RESTAURANT
define('API_CHANGE_STATUS_GET_WORKING_SESSION', '/working-sessions/change-status/%s'); //api.API_GET_LIST_MATERIAL_RESTAURANT
define('API_MATERIAL_UPDATE_UNIT_FOOD', '/material-unit-food-maps/%s/update');
define('API_MATERIAL_UPDATE_UNIT_ORDER_FOOD_MAPS', '/material-unit-quantification-material-maps/%s/update');
define('API_MATERIAL_DELETE_UNIT_ORDER_FOOD_MAPS', '/material-unit-quantification-material-maps/%s/delete'); //api.API_POST_CHANGE_STATUS_MATERIAL_RESTAURANT

/**
 * MATERIAL_CHECK
 */

define('API_MATERIAL_CHECK_LIST_GOOD_POST_ONLY_FOR_CHECK', '/restaurant-materials/brand-allow-check'); //api.API_POST_INVENTORY_MATERIAL_ONLY_FOR_CHECK
define('API_MATERIAL_CHECK_LIST_GOOD_GET_OF_BRANCH', '/restaurant-materials?status=-1'); //api.API_GET_INVENTORY_MATERIAL_OF_BRANCH
define('API_MATERIAL_CHECK_LIST_GOOD_GET_MATERIAL_BRAND_MATERIAL_ONLY_FOR_CHECK', '/restaurant-brand-materials?restaurant_brand_id=%s&status=%s'); //api.APi_GET_MATERIAL_BRAND_MATERIAL_ONLY_FOR_CHECK

/**
 * MATERIAL_TEXT
 */

define('API_MATERIAL_NOT_FOUND', 'Api chưa có');

/**
 * ROLE
 */

define('API_ROLE_GET_DATA', '/employees/roles?branch_id=%s&status=%s&type=%s'); //api.API_GET_ROLE
define('API_ROLE_GET_DATA_ROLE', '/employees/roles?branch_id=%s&status=%s&type=%s'); //api.API_GET_ROLE2
define('API_ROLE_GET_DATA_EMPLOYEE_ROLE', '/employee-roles?branch_id=%s&status=%s&type=%s'); //api.API_GET_ROLE3
define('API_ROLE_CREATE', '/employee-roles/create'); //api.API_CREATE_ROLE
define('API_ROLE_UPDATE', '/employee-roles/%s/update'); //api.AI_UPDATE_ROLE

/**
 * PRICE_ADJUSTMENT
 */

define('API_PRICE_ADJUSTMENT_GET_LIST', '/foods/price-adjustment?restaurant_brand_id=%s&statuses=%s&page=%s&limit=%s'); //api.API_GET_LIST_PRICE_ADJUSTMENT
define('API_PRICE_ADJUSTMENT_GET_DETAIL', '/foods/price-adjustment/%s'); //api.API_GET_DETAIL_PRICE_ADJUSTMENT
define('API_PRICE_ADJUSTMENT_CANCEL_PRICE', '/foods/price-adjustment/%s/cancel'); //api.API_CANCEL_PRICE_ADJSUTMENT
define('API_PRICE_ADJUSTMENT_APPLY', '/foods/price-adjustment/%s/apply'); //api.API_APPLY_PRICE_ADJUSTMENT

/**
 * LIST_AREA
 */

define('API_LIST_AREA_GET', '/areas?branch_id=%s&is_take_away=%s&status=%s'); //api.API_GET_LIST_AREA

/**
 * LIST_BRANCH
 */

define('API_EMPLOYEE_MANAGER_BRANCH_GET', '/branches?restaurant_brand_id=%s&status=%s&is_office=%s'); //api.API_EMPLOYEE_MANAGER_BRANCH_GET

/**
 * WORKING
 */

define('API_WORKING_SESSION_GET_ALL', '/employees/get-all-working-session?restaurant_brand_id=%s&status=%s'); //api.API_GET_ALL_WORKING_SESSION
define('API_WORKING_SESSION_POST_CREATE', '/working-sessions/create'); //api.API_POST_CREATE_WORKING
define('API_WORKING_SESSION_UPDATE', '/working-sessions/update'); //api.API_UPDATE_WORKING_SESSION

/**
 * KITCHEN DATA
 */

define('API_KITCHEN_DATA_GET_DATA', '/restaurant-kitchen-places?restaurant_brand_id=%s&branch_id=%s&status=%s&is_have_printer=-1&is_bar_kitchen=1'); //api.API_GET_LIST_KITCHEN_DATA
define('API_KITCHEN_DATA_GET_DATA_UP', '/restaurant-kitchen-places?restaurant_brand_id=%s&branch_id=%s&status=%s&is_have_printer=%s&is_bar_kitchen=%s&type=%s'); //api.API_GET_LIST_KITCHEN_DATA
define('API_KITCHEN_DATA_GET_DETAIL', '/restaurant-kitchen-places/%s'); //api.API_GET_DETAIL_KITCHEN_DATA
define('API_KITCHEN_DATA_GET_EMPLOYEE', '/restaurant-kitchen-place-employee-map/employees-for-restaurant-kitchen-place-map?restaurant_kitchen_place_id=%s'); //api.API_GET_EMPLOYEE_KITCHEN
define('API_KITCHEN_DATA_GET_DETAIL_KITCHEN', '/restaurant-kitchen-places?restaurant_brand_id=%s'); //api.API_GET_DETAIL_KITCHEN_DATA
define('API_KITCHEN_DATA_ASSIGN_EMPLOYEE', '/restaurant-kitchen-place-employee-map/assign-employees'); //api.API_ASSIGN_EMPLOYEE_KITCHEN_DATA
define('API_KITCHEN_DATA_POST_CREATE', '/restaurant-kitchen-places/create'); //api.API_POST_CREATE_KITCHEN_DATA
define('API_KITCHEN_DATA_POST_CHANGE_STATUS', '/restaurant-kitchen-places/%s/change-status'); //api.API_POST_CHANGE_STATUS_KITCHEN_DATA
define('API_KITCHEN_DATA_GET_FOOD', '/foods/kitchen?restaurant_brand_id=%s&branch_id=%s&kitchen_id=%s&food_status=%s&is_deleted=%s&is_get_food_by_kitchen_id=%s&key_search=%s&limit=%s&page=%s'); //api.API_GET_FOOD_KITCHEN_DATA

define('API_KITCHEN_DATA_GET_LIST_EMPLOYEE', '/employees/bonus-food-review?restaurant_brand_id=%s&branch_id=%s&type=%s'); //api.API_GET_LIST_EMPLOYEE_KITCHEN_DATA
define('API_KITCHEN_DATA_GET_LIST_EMPLOYEE_LEADER', '/employees/master-chef-bonus-food-review?branch_id=%s&type=%s'); //api.API_GET_LIST_EMPLOYEE_LEADER_KITCHEN_DATA
define('API_KITCHEN_DATA_POST_UPDATE_PERMISSION', '/employees/update-employees-bonus-review'); //api.API_POST_UPDATE_PERMISSION_KITCHEN_DATA
define('API_KITCHEN_DATA_POST_UPDATE_PERMISSION_LEADER', '/employees/update-master-chef-bonus-review'); //api.API_POST_UPDATE_PERMISSION_LEADER_KITCHEN_DATA
define('API_KITCHEN_DATA_GET_MATERIAL_UNIT_FOOD_DATA', '/material-unit-food-maps?restaurant_brand_id=%s&material_unit_id=%s&material_unit_specification_exchange_name_id=%s'); //api.API_KITCHEN_DATA_GET_MATERIAL_UNIT_FOOD_DATA
define('API_MATERIAL_POST_MATERIAL_UNIT_FOOD', '/material-unit-food-maps/create'); //api.API_MATERIAL_POST_MATERIAL_UNIT_FOOD
define('API_MATERIAL_POST_MATERIAL_UNIT_ORDER_FOOD', '/material-unit-quantification-material-maps/create'); //api.API_MATERIAL_POST_MATERIAL_UNIT_ORDER_FOOD
define('API_MATERIAL_CHANGE_STATUS_MATERIAL_UNIT_FOOD', '/material-unit-food-maps/%s/delete'); //api.API_MATERIAL_POST_MATERIAL_UNIT_FOOD
define('API_MATERIAL_CHANGE_STATUS_MATERIAL_UNIT_ORDER_FOOD', '/material-unit-quantification-material-maps/%s/delete');
/**
 * PRIVILEGES_ROLE
 */

define('API_PRIVILEGES_ROLE_GET_DATA', '/employee-roles/%s/privileges?branch_id=%s'); //api.API_GET_PRIVILEGES_ROLE
define('API_PRIVILEGES_ROLE_GET_DATA_GROUP', '/employee-privilege-groups?branch_id=%s'); //api.API_GET_ALL_PRIVILEGES
define('API_PRIVILEGES_ROLE_GET_DATA_GROUPS', '/privilege-groups?branch_id=%s'); //api.API_GET_ALL_PRIVILAGE
define('API_PRIVILEGES_ROLE_UPDATE', '/employee-roles/%s/change-privileges'); //api.API_UPDATE_PRIVILEGES_ROLE

/**
 * PRIVILEGES_EMPLOYEE
 */
define('API_PRIVILEGES_EMPLOYEE_GET_DATA', '/employees/%s/privileges?branch_id=%s'); //api.API_GET_PRIVILEGES_EMPLOYEE
define('API_PRIVILEGES_EMPLOYEE_UPDATE', '/employees/%s/privileges'); //api.API_UPDATE_PRIVILEGES_EMPLOYEE

/**
 * TEMPORARY_FOOD
 */

define('API_TEMPORARY_FOOD_ASSIGN', '/foods/assign-temporary'); //api.API_ASSIGN_TEMPORARY_FOOD

/**
 * CHANGE_MANAGER
 */

define('API_CHANGE_MANAGER_TEMPORARY_FOOD_ASSIGN', '/areas?status=1&branch_id=%s'); //api.API_GET_LIST_EMPLOYEE_MANAGER_AREAS
define('API_CHANGE_MANAGER_GET_DATA', '/employees?branch_id=%s&status=%s&is_include_restaurant_manager=%s&is_take_myself=%s'); //api.API_GET_LIST_ALL_EMPLOYEE
define('API_CHANGE_MANAGER_POST_BRANCH', '/employees/%s/change-privilege-to-branch-manager'); //api.API_POST_CHANGE_MANAGER_BRANCH
define('API_CHANGE_MANAGER_POST_CHANGE_AREA', '/employees/%s/change-privilege-to-area-manager'); //api.API_POST_CHANGE_MANAGER_AREA

/**
 * INVENTORY
 */


define('API_GET_LIST_REQUEST_ORDER', '/restaurant-material-order-request?restaurant_brand_id=%s&branch_id=%s&employee_role_id=%s&status=%s&key_search=%s&employee_create_id=%s&employee_confirm_id=%s&employee_cancel_id=%s&from_date=%s&to_date=%s&material_category_type_parent_id=%s&branch_inner_inventory_type=%s&is_user=%s&page=%s&limit=%s'); //api.API_GET_LIST_INTERNAL_ORDER_SUPPLIERdefine('API_GET_LIST_ORDER_RESTAURANT', '/supplier-order-request?branch_id=%s&supplier_id=%s&status=%s&from_date=%s&to_date=%s&page=%s&limit=%s&key_search=%s'); //api.API_GET_LIST_ORDER_RESTAURANT
define('API_GET_LIST_INTERNAL_ORDER_SUPPLIER', '/restaurant-material-order-request?branch_id=%s&status=%s&from_date=%s&to_date=%s&page=%s&limit=%s&key_search=%s');
define('API_GET_LIST_ORDER_RESTAURANT', '/supplier-order-request?branch_id=%s&supplier_id=%s&status=%s&from_date=%s&to_date=%s&page=%s&limit=%s&key_search=%s');
define('API_GET_LIST_ORDER_SUPPLIER', '/supplier-orders?branch_id=%s&supplier_id=%s&status=%s&from_date=%s&to_date=%s&page=%s&limit=%s&is_return_all_total_material=%s&key_search=%s'); //api.API_GET_LIST_ORDER_SUPPLIER
define('API_GET_DETAIL_REQUEST_ORDER_SUPPLIER', '/restaurant-material-order-request/%s'); //api.API_GET_DETAIL_REQUEST_ORDER_SUPPLIER
define('API_GET_DETAIL_MATERIAL_REQUEST_ORDER_SUPPLIER', '/restaurant-material-order-request/%s/restaurant-material-order-request-detail?restaurant_brand_id=%s&branch_id=%s&is_user=%s'); //api.API_GET_DETAIL_MATERIAL_REQUEST_ORDER_SUPPLIER
define('API_GET_LIST_MATERIAL_REQUEST_ORDER_SUPPLIER', '/branch-materials/total-quantity?branch_id=%s&material_category_type_parent_id=%s'); //api.API_GET_LIST_MATERIAL_REQUEST_ORDER_SUPPLIER
define('API_POST_UPDATE_REQUEST_ORDER_SUPPLIER', '/supplier-order-request/confirm'); //api.API_POST_UPDATE_REQUEST_ORDER_SUPPLIER
define('API_POST_STATUS_REQUEST_ORDER_SUPPLIER', '/restaurant-material-order-request/%s/change-status'); //api.API_POST_STATUS_REQUEST_ORDER_SUPPLIER
define('API_POST_CONFIRM_REQUEST_ORDER_SUPPLIER', '/supplier-order-request/change-status-all'); //api.API_POST_CONFIRM_REQUEST_ORDER_SUPPLIER
define('API_GET_RETURN_ORDER_SUPPLIER', '/supplier-material-return-requests?branch_id=%s&status=%s&from_date=%s&to_date=%s&supplier_id=%s&page=%s&limit=%s&key_search=%s'); //api.API_GET_RETURN_ORDER_SUPPLIER
define('API_POST_RETURN_ORDER_SUPPLIER', '/warehouses/return-material-supplier'); //api.API_POST_RETURN_ORDER_SUPPLIER

define('API_GET_LIST_MATERIAL_ORDER_SUPPLIER', '/branch-materials/branch-inventory-by-account?branch_id=%s&material_category_type_parent_id=%s'); //api.API_GET_LIST_MATERIAL_ORDER_SUPPLIER
define('API_GET_LIST_MATERIAL_INVENTORY_ORDER_SUPPLIER', '/warehouses/inventory?branch_id=%s&material_category_type_parent_id=%s'); //api.API_GET_LIST_MATERIAL_ORDER_SUPPLIER

define('API_POST_CONFIRM_RESTAURANT_ORDER_SUPPLIER', '/supplier-orders/confirm'); //api.API_POST_CONFIRM_RESTAURANT_ORDER_SUPPLIER
define('API_POST_STATUS_RESTAURANT_ORDER_SUPPLIER', '/supplier-order-request/%s/change-status'); //api.API_POST_STATUS_RESTAURANT_ORDER_SUPPLIER
define('API_GET_MATERIAL_RESTAURANT_ORDER_SUPPLIER', '/branch-materials/total-quantity?branch_id=%s&material_category_type_parent_id=%s'); //api.API_GET_LIST_MATERIAL_REQUEST_ORDER_SUPPLIER
define('API_GET_DETAIL_MATERIAL_RESTAURANT_ORDER_SUPPLIER', '/supplier-order-request/%s'); //api.API_GET_DETAIL_MATERIAL_RESTAURANT_ORDER_SUPPLIER
define('API_GET_LIST_MATERIAL_RESTAURANT_ORDER_SUPPLIER', '/supplier-order-request/%s/supplier-order-request-detail'); //api.API_GET_LIST_MATERIAL_RESTAURANT_ORDER_SUPPLIER
define('API_POST_UPDATE_RESTAURANT_ORDER_SUPPLIER', '/supplier-order-request/%s/update'); //api.API_POST_UPDATE_RESTAURANT_ORDER_SUPPLIER

define('API_POST_RECEIVED_ORDER_SUPPLIER', '/supplier-orders/%s/complete'); //api.API_POST_RECEIVED_ORDER_SUPPLIER
define('API_GET_DETAIL_ORDER_SUPPLIER', '/supplier-orders/%s'); //api.API_GET_DETAIL_ORDER_SUPPLIER
define('API_GET_MATERIAL_ORDER_SUPPLIER', '/supplier-orders/%s/supplier-order-detail?restaurant_brand_id=%s&branch_id=%s&supplier_id=%s'); //api.API_GET_MATERIAL_ORDER_SUPPLIER
define('API_POST_STATUS_ORDER_SUPPLIER', '/supplier-orders/%s/change-status'); //api.API_POST_STATUS_ORDER_SUPPLIER

define('API_GET_DETAIL_RETURN_INVENTORY_ORDER', '/supplier-material-return-requests/%s'); //api.API_GET_DETAIL_RETURN_Inventory_ORER
define('API_GET_COUNT_ORDER_SUPPLIER', '/supplier-orders/tab-count-order?branch_id=%s&from_date=%s&to_date=%s&key_search=%s&type_tab=%s'); //api.API_GET_COUNT_ORDER_SUPPLIER

define('API_GET_TOTAL_ORDER_RESTAURANT', '/supplier-order-request/total-order?branch_id=%s&supplier_id=%s&from_date=%s&to_date=%s&status=%s&key_search=%s'); //api.API_GET_TOTAL_ORDER_RESTAURANT
define('API_GET_TOTAL_ORDER_SUPPLIER', '/supplier-orders/total-order?branch_id=%s&supplier_id=%s&status=%s&from_date=%s&to_date=%s&page=%s&limit=%s&is_return_all_total_material=%s&key_search=%s'); //api.API_GET_TOTAL_ORDER_SUPPLIER
define('API_GET_TOTAL_ORDER_RETURN', '/supplier-material-return-requests/total-order?branch_id=%s&status=%s&from_date=%s&to_date=%s&supplier_id=%s&page=%s&limit=%s&key_search=%s'); //api.API_GET_TOTAL_ORDER_RETURN

define('API_INVENTORY_GET_LIST', '/warehouses/warehouse-session?page=%s&branch_id=%s&types=%s&paid_status=%s&is_take_canceled=%s&restaurant_supplier_id=%s&from=%s&to=%s&is_liabilities=%s&limit=%s&is_all_debt_amount=%s&material_category_type_parent_ids=%s&target_branch_id=%s&target_types=%s&key_word=%s&warehouse_session_statuses=%s'); //api.API_GET_LIST_INVENTORY
define('API_INVENTORY_GET_COUNT', '/warehouses/count?branch_id=%s&material_category_type_parent_id=%s&warehouse_session_types=%s&from=%s&to=%s&key_word=%s&target_types=%s&target_branch_id=%s'); //api.API_GET_COUNT_INVENTORY
define('API_INVENTORY_GET_COUNT_OUT', '/warehouses/count?branch_id=%s&material_category_type_parent_id=%s&warehouse_session_types=%s&from=%s&to=%s&key_word=%s&target_types=%s&target_branch_id=%s&warehouse_session_statuses=%s'); //api.API_GET_COUNT_OUT
define('API_INVENTORY_POST_CREATE', '/warehouses/export-inner-branch'); //api.API_POST_CREATE_INVENTORY
define('API_INVENTORY_POST_CANCEL', '/warehouses/warehouse-session/%s/cancel'); //api.API_POST_CANCEL_INVENTORY
define('API_INVENTORY_GET_DETAIL', '/warehouses/warehouse-session/%s?branch_id=%s'); //api.API_GET_DETAIL_INVENTORY
define('API_INVENTORY_POST_CREATE_INNER_RETURN', '/warehouse-inner-sessions/return-materials'); //api.API_POST_CREATE_INNER_RETURN_INVENTORY
define('API_INVENTORY_POST_CONFIRM_OUT', '/warehouses/%s/accept-target-branch'); //api.API_POST_CONFIRM_OUT_INVENTORY_BRANCH
define('API_INVENTORY_POST_REJECT', '/warehouses/%s/reject-target-branch'); //api.API_POST_REJECT_INVENTORY_BRANCH

define('API_INVENTORY_INTERNAL_POST_CREATE', '/warehouses/export-target-branch'); //api.API_POST_CREATE_INVENTORY_INTERNAL
define('API_INVENTORY_INTERNAL_GET_LIST', '/warehouse-inner-sessions?branch_id=%s&branch_inner_inventory_types=%s&types=%s&from_date=%s&to_date=%s&key_search=%s&limit=%s&page=%s'); //api.API_GET_LIST_INVENTORY_INTERNAL
define('API_RETURN_INVENTORY_MANAGER_GET_DETAIL', '/warehouse-inner-sessions/%s'); //api.API_GET_DETAI_RETURN_INVENTORY_MANAGER
define('API_CANCEL_INVENTORY_MANAGE_GET_LIST', '/warehouses/cancel-materials'); //api.API_GET_CANCEL_INVENTORY_MANAGE
define('API_INVENTORY_MANAGE_GET_COUNT_TAB', '/warehouse-inner-sessions/count-tab?branch_id=%s&branch_inner_inventory_type=%s&from_date=%s&to_date=%s&warehouse_session_type=%s&key_search=%s'); //api.API_GET_COUNT_TAB_INVENTORY_MANAGE
define('API_INVENTORY_MANAGE_GET_TOTAL_AMOUNT', '/warehouse-inner-sessions/total-amount?branch_id=%s&branch_inner_inventory_types=%s&types=%s&from_date=%s&to_date=%s&key_search=%s'); //api.API_GET_TOTAL_AMOUNT_INVENTORY_MANAGE


define('API_POST_CREATE_CANCEL_INVENTORY', '/warehouse-inner-sessions/cancel-materials'); //api.API_POST_CREATE_CANCEL_INVENTORY
define('API_POST_UPDATE_CANCEL_INVENTORY', '/warehouses/cancel-notes/%s'); //api.API_POST_UPDATE_CANCEL_INVENTORY
define('API_POST_CONFIRM_CANCEL_INVENTORY', '/warehouses/cancel-material/%s/confirm'); //api.API_POST_CONFIRM_CANCEL_INVENTORY
define('API_GET_MATERIAL_CANCEL_INVENTORY', '/warehouse-inner-sessions/inventory?branch_id=%s&branch_inner_inventory_types=%s&material_status=%s&is_delete=%s&is_get_system_last_quantity_different_zero=%s&key_search=%s&limit=%s&page=%s'); //api.API_GET_MATERIAL_CANCEL_INVENTORY

define('API_POST_CREATE_CHECKLIST_GOODS', '/inventory-reports/create'); //api.API_POST_CREATE_CHECKLIST_GOODS
define('API_POST_CREATE_CHECKLIST_BRANCH_WAREHOUSE', '/inventory-warehouse-session/create'); //api.API_POST_CREATE_CHECKLIST_GOODS
define('API_POST_UPDATE_CHECKLIST_GOODS', '/inventory-reports/%s'); //api.API_POST_UPDATE_CHECKLIST_GOODS
define('API_POST_UPDATE_CHECKLIST_BRANCH_WAREHOUSE', '/inventory-warehouse-session/%s/update'); //api.API_POST_UPDATE_CHECKLIST_GOODS
define('API_GET_LIST_CHECKLIST_GOODS', '/inventory-reports?page=%s&limit=%s&branch_id=%s&material_category_type_parent_id=%s&from_date=%s&to_date=%s&status_string=%s'); //api.API_GET_LIST_CHECKLIST_GOODS.
define('API_GET_MOST_RECENT_CHECKLIST_GOOD', '/inventory-warehouse-session/inventory-warehouse-session-detail?branch_id=%s&material_category_type_parent_id=%s');
define('API_GET_LIST_CHECKLIST_BRANCH_INVENTORY', '/inventory-warehouse-session?branch_id=%s&material_category_type_parent_id=%s&status_string=%s&from_date=%s&to_date=%s&page=%s&limit=%s');
define('API_GET_MATERIAL_CHECKLIST_GOODS', '/branch-materials/list-for-inner-check?branch_id=%s&inventory_report_type=%s&branch_inner_inventory_type=%s&time=%s'); //api.API_GET_MATERIAL_CHECKLIST_GOODS
define('API_GET_MATERIAL_CHECKLIST_GOODS_CATEGORY', '/inventory-reports/%s/list-material-for-check?branch_id=%s&material_category_type_parent_id=%s&time=%s&id=%s'); //api.API_GET_MATERIAL_CHECKLIST_GOODS2
define('API_GET_MATERIAL_CHECKLIST_BRANCH_WAREHOUSE', '/inventory-warehouse-session/restaurant-material?branch_id=%s&material_category_type_parent_id=%s');
define('API_GET_DETAIL_CHECKLIST_GOODS', '/inventory-reports/%s'); //api.API_GET_DETAIL_CHECKLIST_GOODS
define('API_GET_DETAIL_CHECKLIST_BRANCH_WAREHOUSE', '/inventory-warehouse-session/%s');
define('API_POST_CONFIRM_CHECKLIST_GOODS', '/inventory-reports/%s/check'); //api.API_POST_CONFIRM_CHECKLIST_GOODS
define('API_POST_STATUS_CHECKLIST_GOODS', '/inventory-reports/%s/change-status'); //api.API_POST_STATUS_CHECKLIST_GOODS
define('API_POST_CHANGE_STATUS_CHECKLIST_BRANCH_WAREHOUSE', '/inventory-warehouse-session/%s/change-status'); //api.API_POST_STATUS_CHECKLIST_GOODS
define('API_GET_LIST_CHECKLIST_GOODS_INTERNAL', '/branch-materials/branch-inventory-reports?branch_id=%s&inventory_report_type=%s&branch_inventory_type=%s&status_string=%s&from_date=%s&to_date=%s&page=%s&limit=%s'); //api.API_GET_LIST_CHECKLIST_GOODS_INTERNAL
define('API_GET_CHECKLIST_GOOD_INTERNAL_FINAL', '/inventory-warehouse-inner-sessions/last-inner-inventory-report-detail?branch_id=%s&inventory_report_type=%s&branch_inner_inventory_type=%s');
define('API_GET_DETAIL_CHECKLIST_GOODS_INTERNAL', '/inventory-warehouse-inner-sessions/%s/detail'); //api.API_GET_DETAIL_CHECKLIST_GOODS_INTERNAL
define('API_POST_UPDATE_TREASURER_CHECKLIST_GOODS_INTERNAL', '/branch-materials/inner-check'); //api.API_POST_UPDATE_TREASURER_CHECKLIST_GOODS_INTERNAL
//define('API_POST_UPDATE_CHECKLIST_GOODS_INTERNAL', '/branch-materials/update-branch-inventory-report');
define('API_POST_UPDATE_CHECKLIST_GOODS_INTERNAL', '/inventory-warehouse-inner-sessions/%s/update');
define('API_POST_STATUS_CHECKLIST_GOODS_INTERNAL', '/inventory-warehouse-inner-sessions/%s/change-status'); //api.API_POST_STATUS_CHECKLIST_GOODS_INTERNAL
define('API_POST_CREATE_CHECKLIST_GOODS_INTERNAL', '/inventory-warehouse-inner-sessions/create'); //api.API_POST_CREATE_CHECKLIST_GOODS_INTERNAL
define('API_POST_CONFIRM_CHECKLIST_GOODS_INTERNAL', '/branch-materials/inner-check'); //api.API_POST_CONFIRM_CHECKLIST_GOODS_INTERNAL
define('API_GET_LIST_CHECKLIST_GOODS_INTERNAL_WAREHOUSE', '/inventory-warehouse-inner-sessions?branch_id=%s&type=%s&branch_inventory_type=%s&creator_type=%s&status_string=%s&from_date=%s&to_date=%s&page=%s&limit=%s'); //api.API_GET_LIST_CHECKLIST_GOODS_INTERNAL



/**
 * WAREHOUSE CENTER
 */

define('API_GET_WAREHOUSE_CENTER_BRANCH', '/branches?restaurant_brand_id=%s&status=%s&is_office=%s');
define('API_GET_WAREHOUSE_CENTER_BRANCH_OFFICE', '/branches/branch-by-branch-office?branch_office_id=%s&key_search=%s');
define('API_POST_ASSIGN_WAREHOUSE_CENTER_BRANCH', '/branches/%s/assigned-branch-office');
define('API_GET_ORDER_REQUEST_WAREHOUSE_CENTER_BRANCH', '/supplier-order-request/office-branch?restaurant_brand_id=%s&target_branch_id=%s&from_date=%s&to_date=%s&status=%s&page=%s&limit=%s&key_search=%s');

/**
 * LEVEL_SALARY
 */

define('API_LEVEL_SALARY_GET_DATA', '/salary-levels'); //api.API_GET_LEVEL_SALARY
define('API_LEVEL_SALARY_CREATE', '/salary-levels/manage'); //api.API_CREATE_LEVEL_SALARY
define('API_SALARY_LEVEL_GET_ALL', '/employees/get-all-salary-level'); //api.API_GET_ALL_SALARY_LEVEL
define('API_SALARY_LEVEL_CHANGE_STATUS', '/salary-levels/%s/change-status'); //api.API_GET_ALL_SALARY_LEVEL


/**
 * CATEGORY_GROUP_MATERIAL
 */

define('API_CATEGORY_GROUP_MATERIAL_GET_DATA', '/restaurant-material-order-request-groups?branch_id=%s&employee_created_id=%s&is_account_created=%s'); //api.API_GET_DATA_CATEGORY_GROUP_MATERIAL
define('API_CATEGORY_GROUP_MATERIAL_POST_CREATE', '/restaurant-material-order-request-groups/create'); //api.API_POST_CREATE_CATEGORY_GROUP_MATERIAL
define('API_CATEGORY_GROUP_MATERIAL_GET_DATA_UPDATE', '/restaurant-material-order-request-groups/%s?is_account_created=%s&branch_id=%s'); //api.API_GET_DATA_UPDATE_CATEGORY_GROUP_MATERIAL
define('API_GROUP_MATERIAL_GET_LIST_MAP', '/restaurant-material-order-request-groups/material?is_account_created=%s&branch_id=%s'); //api.API_GET_DATA_UPDATE_CATEGORY_GROUP_MATERIAL
define('API_CATEGORY_GROUP_MATERIAL_POST_MAP_GROUP_MATERIAL', '/restaurant-material-order-request-groups/%s/assign-material'); //api.API_POST_MAP_GROUP_MATERIAL
define('API_CATEGORY_GROUP_MATERIAL_POST_DELETE', '/restaurant-material-order-request-groups/%s/delete'); //api.API_POST_DELECT_GROUP_MATERIAL
define('API_CATEGORY_GROUP_MATERIAL_POST_UPDATE', '/restaurant-material-order-request-groups/%s/update'); //api.API_POST_UPDATE_CATEGORY_GROUP_MATERIAL

/**
 * SETTING BRANCH
 */

define('API_SETTING_BRANCH_GET_FULL_IN_FOR', '/branches/%s/full-infor'); //api.API_GET_FULL_INFOR_BRANCH
define('API_SETTING_BRANCH_GET_LIST_CITIES', '/administrative-units/cities?country_id=%s'); //api.API_GET_LIST_CITIES
define('API_SETTING_BRANCH_GET_LIST_DISTRICTS', '/administrative-units/districts?city_id=%s'); //api.API_GET_LIST_DISTRICTS
define('API_SETTING_BRANCH_GET_LIST_WARDS', '/administrative-units/wards?district_id=%s'); //api.API_GET_LIST_WARDS
define('API_SETTING_BRANCH_GET_LIST_BRANCH_BUSINESS_TYPE', '/branches/business-type'); //api.API_GET_LIST_BRANCH_BUSINESS_TYPE
define('API_SETTING_BRANCH_POST_UPDATE', '/branches/%s/update-information'); //api.API_POST_UPDATE_BRANCH
define('API_SETTING_BRANCH_POST_UPDATE_BANNER', '/branches/update-banner'); //api.API_POST_UPDATE_BRANCH_BANNER
define('API_SETTING_BRANCH_POST_UPDATE_LOGO', '/branches/%s/update-logo'); //api.API_POST_UPDATE_BRANCH_LOGO
define('API_SETTING_BRANCH_POST_UPDATE_LIST_IMAGE', '/branches/%s/update-image-url'); //api.API_POST_UPDATE_LIST_IMAGE_BRANCH
define('API_SETTING_BRANCH_POST_UPDATE_SETTING', '/branches/%s/setting'); //api.API_POST_UPDATE_SETTING_BRANCH
define('API_SETTING_BRANCH_GET_SEARCH_ADDRESS_FULL', 'http://api.map4d.vn/sdk/place/text-search?key=bc4968a09552cbf525c4b0d9727df6bf&text=%s'); //API_SALE_CUSTOMER_POST_SORT

define('API_SETTING_BRANCH_UPDATE_OFFLINE', '/branches/%s/setting/switch-working-offline-online'); //api.API_UPDATE_OFFLINE_BRANCH
define('API_SETTING_BRANCH_GET_POST', '/branches/%s/setting'); //api.API_GET_POST_SETTING

define('API_SETTING_BRANCH_GET_CARD', '/branches?restaurant_brand_id=%s&status=%s&is_enable_membership_card=%s'); //api.API_GET_BRANCH

/**
 * SETTING RESTAURANT
 */

define('API_SETTING_RESTAURANT_GET_POST', '/restaurants/%s/setting'); //api.API_GET_POST_SETTING_RESTAURANT
define('API_GET_BRAND_POST_SETTING', '/restaurant-brands/%s/setting-brand'); //api.API_GET_POST_SETTING_RESTAURANT
define('API_SETTING_RESTAURANT_GET_PROFILE', '/restaurants/%s'); //api.API_GET_PROFILE_RESTAURANT
define('API_SETTING_RESTAURANT_POST_INFO_SETTING_UPDATE', '/restaurants/update-info'); //api.API_SETTING_RESTAURANT_POST_INFO_SETTING_UPDATE
define('API_SETTING_RESTAURANT_RESTAURANT_BRAND', '/restaurant-brands?status=%s'); //api.API_SETTING_RESTAURANT_RESTAURANT_BRAND

/**
 * SALE SOLUTION SETTING RESTAURANT
 */
define('API_SALE_SOLUTION_SETTING_RESTAURANT', '/restaurants/setting-sale-solution'); //api.API_SALE_SOLUTION_SETTING_RESTAURANT
define('API_SALE_SOLUTION_SETTING_RESTAURANT_UPDATE', '/restaurants/setting-sale-solution'); //api.API_SALE_SOLUTION_SETTING_RESTAURANT_UPDATE
define('API_SETTING_RESTAURANT_POST_UPDATE_LOGO', '/restaurants/sale-solution/update-info'); //api.API_SETTING_RESTAURANT_POST_UPDATE_LOGO
define('API_SETTING_RESTAURANT_POST_UPDATE_LOGO_SALE_SOLUTION', '/restaurants/sale-solution/update-info'); //api.API_SETTING_RESTAURANT_POST_UPDATE_LOGO_SALE_SOLUTION

/**
 * HISTORY_LOG
 */

define('API_HISTORY_LOG_GET_DATA', '/logs/activity?object_id=%s&type=%s&user_id=%s&branch_id=%s&key_search=%s&object_type=%s&from=%s&to=%s&limit=%s&page=%s'); //api.API_GET_HISTORY_LOG
/**
 * BRANDS
 */

//define('API_BRAND_GET_DATA', '/restaurant-brands?status=%s'); //api.API_GET_LIST_BRAND
define('API_BRAND_GET_DATA', '/restaurant-brands/restaurant-resource-privilege-maps?status=%s'); //api.API_GET_LIST_BRAND
define('API_BRAND_GET_SETTING', '/restaurant-brands/%s/setting'); //api.API_POST_CHANGE_BOOKING_BONUS_DATA_SETTING , API_GET_BRAND_SETTING
define('API_BRAND_POST_UPDATE', '/restaurant-brands/%s'); //api.API_POST_UPDATE_BRAND ,
define('API_BRAND_POST_UPDATE_BANNER', '/restaurant-brands/%s/update-banner'); //api.API_POST_UPDATE_BANNER_BRAND
define('API_BRAND_GET_CREATE_SERVICE_LEVELS_RESTAURANT', 'service-restaurant-levels'); //api.API_GET_CREATE_SERVICE_LEVELS_RESTAURANT

/**
 * VAT
 */

define('API_VAT_RESTAURANT_GET_DATA', '/restaurant-vat-configs?is_actived=%s'); //api.API_VAT_RESTAURANT_GET_DATA
define('API_VAT_ADMIN_GET_DATA', '/restaurant-vat-configs/vat-config'); //api.API_VAT_ADMIN_GET_DATA
define('API_VAT_SETTING_CHANGE_STATUS', '/restaurant-vat-configs/accept'); //api.API_CHANGE_STATUS_VAT_SETTING
define('API_VAT_SETTING_UPDATE', '/restaurant-vat-configs/%s/update'); //api.API_VAT_SETTING_UPDATE
define('API_VAT_RESTAURANT_SETTING', '/restaurant-vat-configs/%s/update'); //api.API_VAT_RESTAURANT_SETTING
define('API_VAT_RESTAURANT_ASSIGN', '/restaurant-vat-configs/assign-restaurant'); //api.API_VAT_RESTAURANT_ASSIGN

/**
 * SERVICE COST HISTORY
 */

define('API_SERVICE_COST_HISTORY_DATA', '/service-restaurant-balance'); //api.API_SERVICE_COST_HISTORY_DATA
define('API_SERVICE_COST_HISTORY_DATA_ADD', '/service-restaurant-balance/transaction?report_type=%s&date_string=%s&from_date=%s&to_date=%s&key_search=%s&page=%s&limit=%s'); //api.API_SERVICE_COST_HISTORY_DATA_ADD
define('API_SERVICE_COST_HISTORY_DATA_MINUS', '/service-restaurant-balance/histories?report_type=%s&date_string=%s&from_date=%s&to_date=%s&key_search=%s&page=%s&limit=%s&restaurant_brand_id=%s&branch_id=%s'); //api.API_SERVICE_COST_HISTORY_DATA_MINUS
define('API_SERVICE_COST_HISTORY_COUNT_TAB', '/service-restaurant-balance/count-tab?report_type=%s&date_string=%s&from_date=%s&to_date=%s&restaurant_brand_id=%s&branch_id=%s'); //api.API_SERVICE_COST_HISTORY_COUNT_TAB
/**
 * BANK
 */
define('API_SETTING_BANK_GET_DATA', '/restaurant-brand-bank-accounts?restaurant_brand_id=%s');
define('API_SETTING_BANK_GET_BANK', '/restaurant-brand-bank-accounts/bank-list');
define('API_SETTING_BANK_POST_SEARCH_BANK_NUMBER', '/restaurant-brand-bank-accounts/lookup');
define('API_SETTING_BANK_POST_CREATE', '/restaurant-brand-bank-accounts/create');
define('API_SETTING_BANK_POST_UPDATE', '/restaurant-brand-bank-accounts/%s/update');
define('API_SETTING_BANK_POST_CHANGE_STATUS', '/restaurant-brand-bank-accounts/%s/change-status');
define('API_SETTING_BANK_POST_ASSIGN', '/restaurant-brand-bank-accounts/%s/default');
/**
 * UPLOAD
 */

define('API_UPLOAD_GET_LIST_MEDIA_MULTI', '/api-upload/upload-file-by-user-multi/%s'); //api.API_POST_MULTI_FILE
define('API_UPLOAD_POST_ADV_MARKETING', '/restaurant-private-adverts/create'); //api.API_POST_UPLOAD_ADV_MARKETING

/**
 * TEXT
 */

define('TEXT_ALL_OPTION', 'Tất cả'); // response_text -> component ->  FULL_OPTION
define('TEXT_DEFAULT_OPTION', 'Vui lòng chọn'); // response_text -> component ->  DEFAULT_OPTION
define('TEXT_NULL_OPTION', 'Dữ liệu rỗng'); // response_text -> component ->  NULL_OPTION
define('TEXT_NONE_GIFT_OPTION', 'Không chọn quà'); // response_text -> component ->  NULL_OPTION
define('TEXT_DISABLE_STATUS', 'Tạm ngưng'); // type -> component ->  DISABLE_STATUS
define('TEXT_STATUS_ENABLE', 'Đang hoạt động'); // response_text -> status -> ENABLE,
define('TEXT_WAITING', 'Chờ xác nhận'); // type.status_text.WAIT_PAYMENT
define('TEXT_INVENTORY_MATERIAL', 'Kho nguyên liệu'); // response_text -> inventory ->  MATERIAL
define('TEXT_INVENTORY_GOODS', 'Kho hàng hóa'); // response_text -> inventory ->  GOODS
define('TEXT_INVENTORY_INTERNAL', 'Kho nội bộ'); // response_text -> inventory ->  INTERNAL
define('TEXT_INVENTORY_OTHER', 'Kho khác'); // response_text -> inventory ->  OTHER
define('TEXT_DETAIL', 'Chi tiết'); // response_text -> title-button ->  DETAIL
define('TEXT_UPDATE', 'Chỉnh sửa'); // response_text -> title-button ->WAITING  UPDATE
define('TEXT_COPY', 'Sao chép link'); // response_text -> title-button ->  COPY
define('TEXT_ADD_MORE', 'Bổ sung'); // response_text -> title-button ->  ADD_MORE
define('TEXT_CONFIRM', 'Xác nhận'); // response_text -> title-button ->  CONFIRM
define('TEXT_ENABLE', 'Bật hoạt động'); // response_text -> title-button -> ENABLE // đã đên đây
define('TEXT_CANCEL', 'Hủy'); // response_text -> title-button ->  CANCEL
define('TEXT_CLOSED', 'Đã đóng'); // response_text -> title-button ->  CANCEL
define('TEXT_CANCELED', 'Đã hủy');  // BookingStatusEnum.CANCEL , RestaurantPromotionStatusEnum.CANCELED, SalaryAdditionStatusEnum.CANCEL,WarehouseSessionStatusEnum.CANCELLED, WarehouseSessionPaidStatusEnum.CANCEL
define('TEXT_GIFT', 'Chọn quà tặng'); // response_text -> title-button ->  GIFT
define('TEXT_REMOVE', 'Xóa'); // response_text -> title-button ->  REMOVE
define('TEXT_CONTACT', 'Thông tin liên hệ'); // response_text -> title-button ->  CONTACT
define('TEXT_NOTIFY', 'Phản hồi'); // response_text -> title-button ->  NOTIFY
define('TEXT_DONE', 'Hoàn tất'); // response_text -> status -> DONE
define('TEXT_EDIT', 'Có thể chỉnh sửa'); // response_text -> status -> WAITING
define('TEXT_MONEY', 'VNĐ'); // response_text -> money
define('TEXT_MONDAY', 'Thứ 2');  // response_text -> WeekTimeText -> MONDAY
define('TEXT_TUESDAY', 'Thứ 3');  // response_text -> WeekTimeText -> TUESDAY
define('TEXT_WEDNESDAY', 'Thứ 4');  // response_text -> WeekTimeText -> WEDNESDAY
define('TEXT_THURSDAY', 'Thứ 5');  // response_text -> WeekTimeText -> THURSDAY
define('TEXT_FRIDAY', 'Thứ 6');  // response_text -> WeekTimeText -> FRIDAY
define('TEXT_SATURDAY', 'Thứ 7');  // response_text -> WeekTimeText -> SATURDAY
define('TEXT_SUNDAY', 'Chủ nhật');  // response_text -> WeekTimeText -> SUNDAY
define('TEXT_ADDITION_FEE_RECEIPT', 'Phiếu thu'); // response_text -> additionFeeType -> RECEIPT
define('TEXT_ADDITION_FEE_AUTO_RECEIPT', 'Phiếu thu tự động'); // response_text -> additionFeeType -> AUTO_RECEIPT
define('TEXT_ADDITION_FEE_PAYMENT', 'Phiếu chi'); // response_text -> additionFeeType -> PAYMENT
define('TEXT_ADDITION_FEE_AUTO_PAYMENT', 'Phiếu chi tự động'); // response_text -> additionFeeType -> AUTO_PAYMENT
define('TEXT_DEBIT', 'Ghi nợ'); // type.status_text.DEBIT
define('TEXT_MEDIA_MARKETING_NOT_RUNNING', 'Chưa chạy'); // type.status_text.NOT_RUNNING
define('TEXT_MEDIA_MARKETING_RUNNING', 'Đang chạy'); // type.status_text.RUNNING
define('TEXT_SALARY_CONFIRMED', 'Đã xác nhận'); // type.status_text.REJECTED
define('TEXT_WAITING_EMPLOYEE_CONFIRM', 'Chờ nhân viên xác nhận'); // payroll_status_text.WAITING_EMPLOYEE_CONFIRM
define('TEXT_WAITING_MANAGER_CONFIRM', 'Chờ cấp quản lý xác nhận'); // payroll_status_text.WAITING_MANAGER_CONFIRM
define('TEXT_WAITING_GENERAL_MANAGER_CONFIRM', 'Chờ ban quản lý xác nhận'); // payroll_status_text.WAITING_GENERAL_MANAGER_CONFIRM
define('TEXT_WAITING_APPROVE', 'Chờ ban giám đốc xác nhận'); // payroll_status_text.WAITING_APPROVE
define('TEXT_APPROVE', 'Chờ thủ quỹ chi'); // payroll_status_text.APPROVE
define('TEXT_PAID', 'Đã chi'); // payroll_status_text.PAID
define('TEXT_DENIED', 'Từ chối'); // payroll_status_text.DENIED
define('TEXT_CANCELED_ENUM', 'Hủy'); // payroll_status_text.DENIED
define('TEXT_MATERIAL_DEFAULT_OPTION', 'Chọn nguyên liệu'); // response_text -> component ->  MATERIAL_DEFAULT_OPTION
define('TEXT_FOOD_IN_COMBO_DEFAULT_OPTION', 'Chọn món trong combo'); // response_text -> component ->  DEFAULT_OPTION
define('TEXT_ROLE_EMPLOYEE', 'Chọn bộ phận');
define('TEXT_ALL_ROLE_EMPLOYEE', 'Tất cả bộ phận');
define('TEXT_SELECT_FOOD', 'Chọn món ăn');
define('TEXT_TEMPORARY', 'Bảng tạm');
define('TEXT_SETUP_VAT_FOOD_DEFAULT', 'Chọn VAT');

define('TEXT_QUANTITATIVE_BUTTON', 'Định lượng');

define('TEXT_BOOKING_UNKNOWN', 'Chưa xác định'); // type.status_text.REJECTED
define('TEXT_KITCHEN_DATA_NOTE_KITCHEN', 'Bếp hệ thống'); // type.status_text.NOTE_KITCHEN
define('TEXT_BALLOT_DETAIL', 'Chi tiết phiếu');
define('TEXT_NOT_INVENTORY_CHECKLIST_GOOD', 'Kho chưa kiểm kê');
define('TEXT_USE_IN_PLACE', 'Dùng tại chỗ');
define('TEXT_BUY_TAKE_AWAY', 'Mua mang đi');
define('TEXT_BOTH', 'Cả 2');
define('TEXT_INVENTORY_REPORT_LABELS', '["Tồn đầu", "Nhập", "Xuất", "Hiện tại"]');
define('TEXT_INVENTORY_REPORT_COLORS', '["#fe9365", "#01a9ac", "#fe5d70", "#f2f2f2"');
define('TEXT_INVENTORY_REPORT_COLORS_CHART', ['#00BCD4', '#FFC107', '#283593', '#80DEEA', '#E53935', '#33691E', '#FFF59D', '#512DA8', '#FF7043', '#0288D1', '#FF9999', '#3333FF', '#66FF33', '#FF6666', '#99CC33']);

define('TEXT_MATERIAL', 'Nguyên liệu');
define('TEXT_MAIN_MATERIAL', 'Nguyên liệu chính');
define('TEXT_SUB_MATERIAL', 'Nguyên liệu phụ');
define('TEXT_INDIRECT_MATERIAL', 'Nguyên liệu gián tiếp');
define('TEXT_SPICES', 'Nguyên liệu gia vị');
define('TEXT_DRINK', 'Đồ uống');
define('TEXT_FOOD', 'Thức ăn');
define('TEXT_PRODUCE', 'Vật dụng');
define('TEXT_INTERNAL', 'Thức ăn nội bộ');
define('TEXT_OTHER', 'Khác');

define('TEXT_OWNER_CONFIRM', 'Đã duyệt');
define('TEXT_UNPAID', 'Chưa thanh toán');
define('TEXT_PAID_PAYMENT', 'Đã thanh toán');

define('TEXT_GOODS', 'Loại hàng hóa');
define('TEXT_GOODS_NORMAL', 'Hàng bán');
define('TEXT_GOODS_WEIGTH', 'Hàng bán (KG)');
define('TEXT_GOODS_DRINKS', 'Đồ uống');

define('TEXT_BALANCE', 'Có thể cân bằng');
define('TEXT_BALANCED', 'Đã cân bằng');
define('TEXT_CANCELED_TEXT', 'Đã hủy');
define('TEXT_TEMPORARY_LOCKED', 'Tạm khoá');
define('TEXT_QUIT_JOB', 'Thôi việc');
define('TEXT_QUANTITATIVE', 'Đã định lượng');
define('TEXT_NOT_QUANTITATIVE', 'Chưa định lượng');
define('TEXT_SALARY_VERIFY', 'Chi lương');
define('TEXT_CONFIRM_TREASURER', 'Kế toán xác nhận');
define('TEXT_OWNER_CONFIRM_TREASURER', 'Giám đốc duyệt');
define('TEXT_MANAGE_CONFIRM', 'Quản lý xác nhận');
define('TEXT_SALARY_SEND', 'Gửi chi tiết lương');
define('TEXT_BILL_SEND', 'Xuất hoá đơn điện tử');
define('TEXT_VOUCHER', 'Tạo mã khuyến mãi');
define('TEXT_APPLY', 'Áp dụng');
define('TEXT_UN_APPLY', 'Hủy áp dụng');
define('TEXT_CONFIRM_TABLE', 'Chờ xếp bàn');
define('TEXT_RETURN_DEPOSIT', 'Trả cọc');
define('TEXT_RETURNS', 'Trả hàng');
define('TEXT_ADDITION_FEE', 'Chi tiền');
define('TEXT_CONFIRM_PAYMENT', 'Duyệt chi');
define('TEXT_CONFIRM_REFUND', 'Nhận hoàn tiền, Huỷ phiếu');
define('TEXT_SETUP', 'Setup');
define('TEXT_GOODS_RECEIVED', 'Nhận hàng');
define('TEXT_SEND_SUPPLIER', 'Gửi nhà cung cấp');
define('TEXT_CHOOSE_GIFTS', 'Chọn quà tặng');
define('TEXT_CHOOSE_MATERIAL', 'Chọn nguyên liệu');
define('TEXT_RESET_PASS', 'Reset mật khẩu');
define('TEXT_ADD_FOOD', 'GÁN MÓN ĂN');
define('TEXT_NO_ACTIVE_STATUS', 'Hiện tại, theo quy định pháp luật hệ thống vừa có sự thay đổi về thuế nhấn vào để xem chi tiết.');
define('TEXT_USE_VAT_ADMIN', 'Bạn đang sử dụng VAT mới nhất từ phía ADMIN');
define('TEXT_INFORMATION_USE_VAT_ADMIN', 'Bạn đang sử dụng VAT mới nhất từ phía ADMIN');
define('TEXT_SUPPORT', 'Hỗ trợ');
define('TEXT_UNIFORM', 'Trừ đồng phục');
define('TEXT_PUNISH_WRONG_BILL', 'Trừ nợ/sai bill');
define('TEXT_SALARY_PAYMENT', 'Trừ ứng lương');
define('TEXT_LATE', 'Trừ đi trễ');
define('TEXT_WITHOUT_CHECKOUT', 'Trừ không check-out');
define('TEXT_REWARD', 'Thưởng');
define('TEXT_PUNISH', 'Phạt');
define('TEXT_CHECKLIST_GOODS_TITLE_DAY', 'kiểm kê theo ngày');
define('TEXT_CHECKLIST_GOODS_TITLE_MONTH', 'kiểm kê theo tháng');
define('TEXT_CHECKLIST_GOODS_DAY', 'Phiếu kiểm kê ngày');
define('TEXT_CHECKLIST_GOODS__MONTH', 'Phiếu kiểm kê tháng');
define('TEXT_UNKNOWN', 'Không xác định');
define('TEXT_WAITING_APPLY', 'Đang chờ áp dụng');
define('TEXT_APPLIED', 'Đã được áp dụng');
define('TEXT_PREPARING', 'Chờ nhận khách');
define('TEXT_WAITING_COMPLETE', 'Đang phục vụ');
define('TEXT_CONFINED', 'Chờ xếp bàn');
define('TEXT_WAITING_SET_UP', 'Chờ setup');
define('TEXT_NO_SCHEDULE', 'Không cọc');
define('TEXT_WAITING_SCHEDULE', 'Chờ xác nhận cọc');
define('TEXT_BOOKING_CONFIRMED', 'Đã xác nhận cọc');
define('TEXT_RETURN_COMFIRNED', 'Đã trả cọc');
define('TEXT_APPROVED', 'Đã duyệt');
define('TEXT_PROMOTION_FOOD', 'Giảm giá trên món ăn');
define('TEXT_PROMOTION_ORDER', 'Giảm giá trên hóa đơn');
define('TEXT_PROMOTION_GOLDEN_HOUR', 'Giờ vàng');
define('TEXT_PROMOTION_DONATE', 'Tặng món');
define('TEXT_ALL', 'Tất cả');
define('TEXT_MIN_ORDER_TOTAL_AMOUNT', 'Tổng tiền đơn hàng tối thiểu');
define('TEXT_FOOD_CATEGORY', 'Danh mục món ăn');
define('TEXT_FOODS', 'Món ăn');
define('TEXT_CUSTOMER_GROUP', 'Nhóm khách hàng');
define('TEXT_NO_APPLY', 'Không áp dụng');
define('TEXT_FOOD_FOOD', 'Đồ ăn');
define('TEXT_FOOD_DRINK', 'Nước uống');
define('TEXT_SEA_FOOD', 'Hải sản');

define('TEXT_INVENTORY_BAR', 'Kho Bia');
define('TEXT_INVENTORY_KITCHEN', 'Kho Bếp');
define('TEXT_INVENTORY_BUSINESS_EMPLOYEE', 'Kho nhân viên kinh doanh');
define('TEXT_INVENTORY_FOOD_EMPLOYEE', 'Kho thức ăn nhân viên');
define('TEXT_APPLYING', 'Đang chạy');
define('TEXT_PENDING', 'Tạm dừng');
define('TEXT_EXPIRED', 'Hết hạn');
define('TEXT_LIMIT', 'Giới hạn');
define('TEXT_NO_LIMIT', 'Không giới hạn');
define('TEXT_GET_ALL_BRANCH', 'Áp dụng toàn bộ chi nhánh');
define('TEXT_WATING_TABLE_SALARY', 'Chờ gửi bảng lương');
define('TEXT_WAITING_APPROVE_PAYMENT', 'Chờ duyệt');
define('TEXT_PAYMENT_APPROVED', 'Chờ chi');
define('TEXT_CONFIRMED_PAYMENT', 'Chờ duyệt chi');
define('TEXT_PAYMENT_PAID', 'Đã chi');
define('TEXT_RECEIPT', 'Phiếu thu');
define('TEXT_AUTO_RECEIPT', 'Phiếu thu tự động');
define('TEXT_PAYMENT', 'Phiếu chi');
define('TEXT_AUTO_PAYMENT', 'Phiếu chi tự động');
define('TEXT_NO_PROCESSING', 'Món không chế biến');
define('TEXT_PROCESSING', 'Món chế biến');
define('TEXT_FOR_BILL', 'Theo hóa đơn');
define('TEXT_FOR_ORDER', 'Riêng cho người gọi món');
define('TEXT_SELL_BY_WEIGHT', 'Bán theo kg');
define('TEXT_NOT_SELL_BY_WEIGHT', 'Bán theo phần');
define('TEXT_ALLOW', 'Được đánh giá');
define('TEXT_NOT_ALLOW', 'Không được đánh giá');
define('TEXT_SEND', 'Có gửi');
define('TEXT_NOT_SEND', 'Không gửi');
define('TEXT_ALLOW_USE_POINT', 'Cho phép sử dụng điểm app party');
define('TEXT_NOT_ALLOW_USE_POINT', 'Không cho phép sử dụng điểm app party');
define('TEXT_TAKE_AWAY', 'Mua mang đi');
define('TEXT_NOT_TAKE_AWAY', 'Dùng tại chỗ');
define('TEXT_MERCHANDISE', 'Hàng hóa');
define('TEXT_ESTIMATE_REVENUE', 'Doanh thu ước tính');
define('TEXT_REVENUE_PAID', 'Doanh thu đã thanh toán');
define('TEXT_REVENUE_WAITING', 'Doanh thu đang phục vụ');
define('TEXT_NORMAL_FOOD', 'Món thường');
define('TEXT_COMBO_FOOD', 'Combo');
define('TEXT_NOT_BELONG_MENU', 'Món ngoài menu');
define('TEXT_RESTAURANT_EXTRA_CHARGE', 'Phụ thu');
define('TEXT_COMBO', 'COMBO');
define('TEXT_ADDITION', 'Món bán kèm');
define('TEXT_BAR', 'Kho bia');
define('TEXT_KITCHEN', 'Kho bếp');
define('TEXT_BUSINESS_EMPLOYEE', 'NV kinh doanh');
define('TEXT_OTHER_BRANCH', 'Chi nhánh khác');
define('TEXT_USE_INTERNAL', 'Sử dụng nội bộ');
define('TEXT_RESTAURANT_SUPPLIER', 'NCC sổ tay');
define('TEXT_SYSTEM_SUPPLIER', 'NCC hệ thống');
define('TEXT_REQUEST', 'Phiếu yêu cầu');
define('TEXT_BALLOT_RESTAURANT', 'Phiếu mua hàng');
define('TEXT_ORDER', 'Đơn hàng');
define('TEXT_PAYMENT_CONFIRM', 'Chờ  duyệt chi');
define('TEXT_SUPPLIER_PAID', 'Chờ NCC xác nhận');
define('TEXT_CANCEL_PAYMENT', 'Từ chối, chờ hoàn tiền');
define('TEXT_CANCEL_PAYMENT_REFUNDED', 'Đã hoàn tiền, huỷ phiếu');
define('TEXT_SUPPLIER', 'Nhà cung cấp');
define('TEXT_EMPLOYEE', 'Nhân viên');
define('TEXT_CUSTOMER', 'Khách hàng');
define('TEXT_RECEIPT_BILL', 'Hóa đơn');
define('TEXT_BOOKING', 'Đặt bàn');
define('TEXT_WAITING_OPENING', 'Chờ xử lý');
define('TEXT_CASH', 'Tiền mặt');
define('TEXT_BANK', 'Cà thẻ');
define('TEXT_CASH_AND_BANK', 'Tiền mặt và cà thẻ');
define('TEXT_MEMBERSHIP_CARD', 'Thẻ thành viên');
define('TEXT_TRANSFER', 'Chuyển khoản');
define('TEXT_CASH_AND_TRANSFER', 'Tiền mặt và chuyển khoản');
define('TEXT_NOTE_REASON', 'Hạng mục tự động của hệ thống');
define('TEXT_WAITING_COOKING', 'Chờ chế biến');
define('TEXT_COOKING', 'Đang nấu');
define('TEXT_SOLD_OUT', 'Hết hàng');
define('TEXT_WAITING_ONLINE', 'Xác nhận đặt Online');
define('TEXT_WAITING_RESTAURANT_CONFIRM', 'Chờ Công ty/Nhà hàng xác nhận');
define('TEXT_WAITING_DELIVERY', 'Chờ giao');
define('TEXT_DELIVERY', 'Đang giao');
define('TEXT_RETURN_TO_SUPPLIER', 'Trả hàng');
define('TEXT_CONFIRM_RETURN', 'Xác nhận trả');
define('TEXT_OFFICE', 'Khối văn phòng');
define('TEXT_BUSINESS', 'Khối kinh doanh');
define('TEXT_PRODUCTION', 'Khối sản xuất');
define('TEXT_MARKETING', 'Khối Marketing');
define('TEXT_HOURS', 'HOURS');
define('TEXT_DAY_OF_WEEK', 'Thứ');
define('TEXT_DAY', 'Ngày');
define('TEXT_MONTH', 'Tháng');
define('TEXT_QUARTER', 'Quý');
define('TEXT_NONE_MONTH', '0 Tháng');
define('TEXT_FOREVER_MONTH', 'Vĩnh viễn');
define('TEXT_YEAR', 'Năm');
define('TEXT_SUNDAY_OF_WEEK', 'Chủ nhật');
define('TEXT_FEMALE', 'Nữ');
define('TEXT_MALE', 'Nam');
define('TEXT_FEMALE_VALUE', 0);
define('TEXT_MALE_VALUE', 1);
define('TEXT_WAITING_CONFIRM', 'Chờ Duyệt');
define('TEXT_CONFIRMED_CHARGED', 'Đã Nạp');
define('TEXT_UNCHARGED', 'Chưa Nạp');

/**
 * TEXT KITCHEN BUILD DATA
 */
define('TEXT_KITCHEN_BUILD_DATA_BEER_BAR_GOODS', 'Kho bia/quầy bar/hàng hóa'); // KitchenTypeBuildData -> BEER_BAR_GOODS
define('TEXT_KITCHEN_BUILD_DATA_KITCHEN', 'Bếp nấu'); // KitchenTypeBuildData -> KITCHEN
define('TEXT_KITCHEN_BUILD_DATA_CASHIER', 'Thu ngân'); // KitchenTypeBuildData -> CASHIER
define('TEXT_KITCHEN_BUILD_DATA_FISH_BOWL', 'Hồ hải sản'); // KitchenTypeBuildData -> FISH_BOWL
define('TEXT_KITCHEN_BUILD_DATA_TOPPING', 'Topping'); // KitchenTypeBuildData -> TOPPING
define('TEXT_KITCHEN_ASSIGN_EMPLOYEE', 'Gán bếp cho nhân viên'); // KitchenTypeBuildData -> TOPPING

return [
    'api_auth' => [
        'API_GET_SETTING' => '/employees/settings',
        'API_LOGIN' => '/employees/login',
        'API_GET_CONFIG' => '/configs?restaurant_name=%s&project_id=%s',
        'API_FORGOT_PASSWORD' => '/employees/forgot-password',
        'API_CHANGE_PASSWORD' => '/employees/verify-change-password',
        'API_LOGIN_ALOLINE' => '/customers/login',
    ],
    'cache_session' => [
        'KEY_SESSION_ACCOUNT' => 'KEY_SESSION_ACCOUNT',
        'KEY_ACCESS_TOKEN' => 'KEY_ACCESS_TOKEN',
        'KEY_TOKEN_NOTIFICATION' => 'KEY_TOKEN_NOTIFICATION',
        'KEY_DOMAIN_URL' => 'KEY_DOMAIN_URL',
        'KEY_DOMAIN_CHAT' => 'KEY_DOMAIN_CHAT',
        'KEY_USER_ID_CHAT' => 'KEY_USER_ID_CHAT',
        'KEY_BASE_URL' => 'KEY_BASE_URL',
        'KEY_BASE_URL_CHAT' => 'KEY_BASE_URL_CHAT',
        'KEY_BASE_URL_ADS' => 'KEY_BASE_URL_ADS',
        'RESTAURANT_BRANCH' => 'RESTAURANT_BRANCH',
        'Menu' => 'Menu',
        'PERMISSION' => 'PERMISSION',
        'KEY_LEVEL' => 'KEY_LEVEL',
        'RESTAURANT' => 'RESTAURANT',
        'KEY_TMS' => 'KEY_TMS',
        'KEY_ACCESS_TOKEN_CHAT' => 'KEY_ACCESS_TOKEN_CHAT',
        'KEY_ACCESS_TOKEN_FACEBOOK' => 'KEY_ACCESS_TOKEN_FACEBOOK',
        'KEY_FACEBOOK_URL' => 'KEY_FACEBOOK_URL',
        'LENGTH_DATA_TABLE' => 'LENGTH_DATA_TABLE',
        'KEY_ARRAY_PERMISSIONS' => 'KEY_ARRAY_PERMISSIONS',
        'KEY_BRANCH_VIEW' => 'KEY_BRANCH_VIEW',
        'DATA_SETTING' => 'DATA_SETTING',
        'AVATAR' => 'AVATAR',
        'CACHE_IMG' => 'CACHE_IMG',
        'KEY_CONFIG' => 'KEY_CONFIG',
        'VERSION_DASHBOARD' => 'VERSION_DASHBOARD',
        'KEY_SESSION_USER_FACEBOOK' => 'KEY_SESSION_USER_FACEBOOK',
        'KEY_SESSION_DETAIL_PAGES_FACEBOOK' => 'KEY_SESSION_DETAIL_PAGES_FACEBOOK',
        'KEY_CONFIG_NODE' => 'KEY_CONFIG_NODE',
        'KEY_CONFIG_NODE_ALOLINE' => 'KEY_CONFIG_NODE_ALOLINE',
        'KEY_ID_PAGE_FACEBOOK_CONNECT' => 'KEY_ID_PAGE_FACEBOOK_CONNECT',
        'KEY_ID_MESSAGE_FACEBOOK_SELECTED' => 'KEY_ID_MESSAGE_FACEBOOK_SELECTED',
        'IS_ENABLE_RESTAURANT_MEMBERSHIP_CARD' => 'IS_ENABLE_RESTAURANT_MEMBERSHIP_CARD',
        'STATUS_SERVER' => 'STATUS_SERVER',
        'DATA_RESTAURANT' => 'DATA_RESTAURANT',
        'PAGE_CURRENT_HISORY' => 'PAGE_CURRENT_HISORY',
        'KEY_CONFIG_NODE_ALL' => 'KEY_CONFIG_NODE_ALL',
        'STATUS_LOGIN_CHAT' => 'STATUS_LOGIN_CHAT',
        'PATH_ORDER' => 'PATH_ORDER',
        'KEY_TOKEN_OAUTH' => 'KEY_TOKEN_OAUTH',
        'KEY_TOKEN_OAUTH_ALOLINE' => 'KEY_TOKEN_OAUTH_ALOLINE',
        'AVATAR_DEFAULT' => 'AVATAR_DEFAULT',
        'PERMISSION_TALLEST' => 'PERMISSION_TALLEST',
        'ACTIVE_FACEBOOK' => 'ACTIVE_FACEBOOK',
        'HOUR_TO_TAKE_REPORT' => 'HOUR_TO_TAKE_REPORT',
        'SETTING_RESTAURANT' => 'SETTING_RESTAURANT',
        'RESTAURANT_DATA' => 'RESTAURANT_DATA',
        'KEY_TOKEN_NOTIFICATION_CHAT' => 'KEY_TOKEN_NOTIFICATION_CHAT',
        'CATEGORY_STICKER_CHAT' => 'CATEGORY_STICKER_CHAT',
        'CURRENT_PATH' => 'CURRENT_PATH',
        'CURRENT_PAGE_FACEBOOK_CONNECT' => 'CURRENT_PAGE_FACEBOOK_CONNECT',
        'SHOW_LOG_NAVBAR' => 'SHOW_LOG_NAVBAR',
        'CHECK_REFRESH_TOKEN' => 'CHECK_REFRESH_TOKEN',
    ],

    'GATEWAY' => [
        'PROJECT_ID' => [
            'OAUTH' => 8888,
            'OAUTH_v3' => 8888,
            'OAUTH_ALOLINE' => 12345,
            'OAUTH2' => 88888,
            'ALOLINE' => 8082,
            'TMS' => 8095,
            'ORDER' => 8095,
            'ORDER2' => 80948094,
            'SUPPLIER' => 8087,
            'ADMIN' => 8088,
            'CHAT' => 7024,
            //            'LOGS' => 1487,
            'UPLOAD' => 1488,
            'ALOLINE_NODE' => 1485,
            'OAUTH_NODE' => 9999,
            'OAUTH_NODE_ALOLINE' => 123456,
            'REPORT_NODE' => 1486,
            'REPORT_NODE_V2' => 1489,
            'PROMOTION' => 0,
            'LOGS' => 7017
        ],
        'METHOD' => [
            'GET' => 0,
            'POST' => 1
        ]
    ],
    'version' => [
        'VERSION_DASHBOARD' => '2',
        'MONTH' => date('m'),
        'VERSION_UPDATE' => '4',
        'CONTENT' => 'Cập nhật Công ty/Nhà hàng Level 4 - 11',
        'IMPORTANT' => '1' // 0: không quan trọng, 1: quan trọng, logout, clear cache
    ],
    'type' => [
        'manage' => [
            'CREATE' => '0',
            'MANAGER_NONE' => '0',
            'DELETE_YES' => '1',
            'DELETE_NONE' => '0'
        ],
        'data' => [
            'GET_ALL' => '-1',
            'NONE' => '',
            'DEFAULT' => '0',
            'MIN_VALUE' => '1',
        ],
        'date' => [
            'NONE' => '',
            'GET_ALL' => '-1',
            'HOUR' => '0',
            'TODAY' => '1',
            'YESTERDAY' => '11',
            'WEEK' => '2',
            'LAST_WEEK' => '22',
            'MONTH' => '3',
            'LAST_MONTH' => '33',
            'THREE_MONTH' => '4',
            'YEAR' => '5',
            'LAST_YEAR' => '55',
            'THREE_YEAR' => '6',
            'ALL_YEAR' => '8'
        ],
        'category' => [
            'GROUP' => 1,
            'PRODUCT' => 0,
            'FOOD' => 1,
            'DRINK' => 2,
            'OTHER' => 3,
            'SEA_FOOD' => 4,
            'COMBO' => 6,
        ],
        'is_just_take_out_stock' => [
            'GET_ALL' => '-1',
            'GET_NOT_OUT_STOCK' => '0',
            'GET_OUT_STOCK' => '1',
        ],
        'default' => [
            'LIMIT_1000' => 1000,
            'LIMIT_100' => 100,
            'LIMIT_50' => 50,
            'LIMIT_20' => 20,
            'LIMIT_10' => 10,
            'LIMIT_5' => 5,
            'LIMIT_1' => 1,
            'PAGE_DEFAULT' => 1,
            'LIMIT_DEFAULT' => 50000,
            'LIMIT_5000' => 5000,
            'RESTAURANT_DEFAULT' => -1, // all
            'RESTAURANT_PERIOD' => 0, // theo kỳ
            'HISTORY_INVENTORY' => 0, // theo kỳ
        ],
        'role' => [
            'GET_ALL' => '-1',
        ],
        'status' => [
            'STATUS_SUCCESS' => 200,
            'STATUS_CONFIRM' => 300,
            'STATUS_ERROR' => 500,
            'GET_ALL' => -1,
            'GET_ACTIVE' => 1,
            'OPENING' => 0,
            'PAYMENT' => 1,
            'DONE' => 2,
            'MERGED' => 3,
            'COMPLETE' => 4,
            'DEBIT' => 5,
            'PENDING' => 6,
            'DELIVERING' => 7,
            'CANCELLED' => 8,
            'UNKNOWN' => 9,
            'WAITING_CONFIRM' => 1,
            'CONFIRMED' => 2
        ],
        'is_liabilities' => [
            'GET_ALL' => '-1',
            'GET_DEBT' => '0',
            'GET_LIABILITIES' => '1',
        ],
        'checkbox' => [
            'GET_ALL' => -1,
            'DIS_SELECTED' => 0,
            'SELECTED' => 1,
            'CANCEL' => 3,
        ],

        'id' => [
            'NONE' => '',
            'GET_ALL' => '-1',
            'DEFAULT' => '0',
            'UPDATE' => '1',
        ],
        'is_group_by_category' => [
            'FOOD' => '0',
            'CATEGORY' => '1'
        ],
        'supplier' => [
            'GET_ALL' => '-1',
            'GET_ACTIVE' => '0',
        ],
        'temporary' => [
            'GET_ALL' => '-1',
            'DAY' => '1',
            'PERIODIC' => '2',
        ],
        'warehouse_status' => [
            'EDIT' => '0',
            'OPENING' => '1',
            'DONE' => '2',
            'COMPLETE' => '3',
        ],
        'discount' => [
            'PERCENT' => '1',
            'AMOUNT' => '2',
        ],
        'employees' => [
            'GET_ALL' => '-1',
            'GET_ACTIVE' => '1',
        ],
        'branch' => [
            'GET_ALL' => '-1',
            'GET_NOT_OFFICE' => '0',
        ],
        'type_date' => [
            'BY_DATE' => '1',
            'BY_MONTH' => '2',
        ],
        'is_take_canceled' => [
            'GET_ALL' => '1',
            'EXCEPT_DONE' => '2',
        ],
        'WarehouseSessionStatusEnum' => [
            'PENDING' => 0,
            'PROCESSING' => 1,
            'COMPLETED' => 2,
            'CANCELLED' => 3,
            'GET_ALL' => '0,1,2,3',
        ],
        'WarehouseTypeEnum' => [
            'NONE' => '',
            'IN' => 0,
            'OUT' => 1,
            'CANCELLED' => 3,
            'RETURN' => 2,
            'IN_INTERNAL' => 5,
            'OUT_INTERNAL' => 6,
            'ALL_IN' => '0,5',
            'ALL_OUT' => '1,6',
        ],
        'paymentDebtEnumStatus' => [
            'PENDING' => 0, // Chờ gửi
            'SENT' => 1, // Đã gửi chờ xác nhận
            'PROCESSED' => 2, // Xong
            'ALL_ENABLE' => "1,2"
        ],
        'is_exclude_selected' => [
            'GET_ALL' => '0',
            'GET_NOT_SUPPLIER_CURRENT' => '1'
        ],
        'WarehouseSessionPaidStatusEnum' => [
            'GET_ALL' => -1,
            'WAITING_PAYMENT' => 0,
            'WAITING_CONFIRM' => 1,
            'PAID' => 2,
            'UNKNOWN' => 3,
            'CANCEL' => 4,
        ],
        'warehouse' => [
            'INPUT' => '0',
            'OUTPUT' => '1',
        ],
        'order' => [
            'OPENING' => '0',
            'PAYMENT' => '1',
            'API_GET_TABLE_LIST' => '2',
            'MERGED' => '3',
            'COMPLETE' => '4',
            'DEBIT' => '5',
            'CANCELLED' => '8',
            'ALL_DONE' => '2,5',
            'ALL_OPENING' => '0,1,4',
        ],
        'paymentStatus' => [
            'PAYMENT' => 0, // Chưa thanh toán
            'WAITING_PAYMENT' => 1, // chờ thanh toán
            'CONFIRM' => 2, // Đã thanh toán
        ],
        'addition_fee' => [
            'IN' => 0,
            'OUT' => 1,
            'GET_ALL' => -1,
            'NONE' => ''
        ],
        'addition_fee_status' => [
            'PROCESSING' => '1',
            'DONE' => '2',
            'CANCEL' => '3',
        ],
        'payroll' => [
            'PENDING' => 0,
            'WAITING_EMPLOYEE_CONFIRM' => 1,
            'WAITING_MANAGER_CONFIRM' => 2,
            'WAITING_GENERAL_MANAGER_CONFIRM' => 3,
            'WAITING_APPROVE' => 4,
            'APPROVED' => 5,
            'PAID' => 6,
            'DENIED' => 7,
            'OWNER_CONFIRM' => [1, 2, 3, 4],
            'MANAGE' => '0,1,2,3,4,5,6,7',
            'TREASURER' => '0,1,2,3,4,5,6,7',
        ],
        'payroll_status_text' => [
            'PENDING' => 'Bảng tạm',
            'WAITING_EMPLOYEE_CONFIRM' => 'Chờ NV xác nhận',
            'WAITING_MANAGER_CONFIRM' => 'Chờ QL xác nhận',
            'WAITING_GENERAL_MANAGER_CONFIRM' => 'Chờ BQL xác nhận',
            'WAITING_APPROVE' => 'Chờ GĐ duyệt',
            'APPROVED' => 'Chờ TQ chi',
            'PAID' => 'Đã chi',
            'DENIED' => 'Từ chối',
        ],
        'fund' => [
            'PENDING' => '0',
            'PROCESSING' => '1',
            'COMPLETED' => '2',
            'CANCELED' => '3',
            'UNKNOW' => '4',
        ],
        'is_take_away' => [
            'GET_ALL' => '-1',
            'NO_TAKE_AWAY' => '0',
            'GET_TAKE_AWAY' => '1',
        ],

        'is_canceled_order_detail' => [
            'NOT_CANCEL' => '0',
            'CANCEL' => '1',
        ],
        'key_branch_view' => [
            'ALL' => '0',
            'DEFAULT' => '1'
        ],
        'is_order_by_profit' => [
            'REVENUE' => '0',
            'PROFIT' => '1'
        ],
        'order_status' => [
            'OPENING' => '0',
            'WAITING_PAYMENT' => '1',
            'DONE' => '2',
            'MERGED' => '3',
            'WAITING_COMPLETE' => '4',
            'DEBT' => '5',
            'PENDING' => '6',
            'DELIVERING' => '7',
            'CANCELLED' => '8',
            'UNKNOW' => '9',
            'ORDER_STATUS_REPORT' => '2,5',
        ],
        'limit' => [
            'TOP3' => '3',
            'TOP5' => '5',
            'TOP10' => '10'
        ],
        'is_check' => [
            'TRUE' => '1',
            'FALSE' => '0',
        ],
        'inventory' => [
            'WAIT' => 6,
            'GET_ALL' => -1,
            'MATERIAL' => 1,
            'GOODS' => 2,
            'INTERNAL' => 3,
            'OTHER' => 12,
            'IN' => 0,
        ],
        'sub_inventory' => [
            'GET_ALL' => '-1',
            'MAIN_MATERIAL' => '4',
            'SUB_MATERIAL' => '5',
            'INDIRECT_MATERIAL' => '6',
            'SPICES' => '7',
            'DRINK' => '8',
            'FOOD' => '9',
            'PRODUCE' => '10',
            'INTERNAL' => '11',
            'OTHER' => '13',
        ],
        'enum_checklist_goods' => [ //chuẩn bị bỏ
            'PENDING' => '0',
            'COMPLETED' => '2',
            'CANCELLED' => '3',
        ],
        'SalaryAdditionTypeEnum' => [
            'GET_ALL' => '-1',
            'OTHER_REWARD_PUNISH' => '0', //THƯỞNG PHẠT KHÁC
            'SUPPORT' => '1', // hổ trợ
            'UNIFORM' => '2', // đồng phục
            'PUNISH_WRONG_BILL' => '3', // sai hóa đơn
            'SALARY_PAYMENT' => '4', // trả lương
            'LATE' => '5', // đi trể
            'WITHOUT_CHECKOUT' => '6', // không kiểm tra
            'OTHER_REWARD' => '00', // phần thưởng khác ;K
            'OTHER_PUNISH' => '01', // trừ phạt khác ;
            'REWARD' => '0', // GIẢI THƯỞNG
            'PUNISH' => '1', // TRỪ PHẠT
        ],
        'EmployeeBonusPunishStatusTypeEnum' => [
            'PENDING' => '0',
            'CONFIRMED' => '1',
            'APPROVED' => '2',
            'CANCEL' => '3',
            'OTHER' => '4',
        ],
        'unit_type_enum' => [
            'BIG' => 1,
            'SMALL' => 2,
        ],
        'FoodPriceAdjustmentStatusEnum' => [
            'WAITING_APPLY' => '1',
            'APPLIED' => '2',
            'CANCEL' => '3',
            'OTHER' => '4',
        ],
        'BookingStatusEnum' => [
            'WAITING_CONFIRM' => 1,
            'SET_UP' => 2,
            'WAITING_COMPLETE' => 3,
            'COMPLETED' => 4,
            'CANCEL' => 5,
            'UNKONW' => 6,
            'CONFIMED' => 7,
            'EXPIRED' => 8,
            'PREPARING' => 9,
            'GET_ALL' => '1,2,3,4,5,6,7,8,9',
        ],
        'TypeUploadImageNodeEnum' => [
            'USER_AVATAR' => '1',
            'BRANCH' => '2',
            'KAIZEN' => '3',
            'FOOD' => '4',
            'NEW_FEED' => '5',
            'REWARD' => '6',
            'PUNISH' => '7',
            'BIRTHDAY' => '8',
        ],
        'RestaurantBudgetStatusEnum' => [
            'PENDING' => 0,
            'PROCESSING' => 1, // bỏ
            'COMPLETED' => 2,
            'CANCELED' => 3,
            'UNKNOW' => 4,
        ],
        'RestaurantPromotionStatusEnum' => [
            'PENDDING' => '1',
            'APPLYING' => '2',
            'PAUSING' => '3',
            'EXPIRED' => '4',
            'CANCELED' => '5',
        ],
        'RestaurantPromotionTypeStatusEnum' => [
            'PENDING' => '0',
            'APPLYING' => '2',
            'PAUSING' => '3',
            'EXPIRED' => '4',
            'CANCELED' => '5',
        ],
        'AdditionFeeStatusEnum' => [
            'GET_ALL' => -1,
            'UNKNOW' => 0,
            'ORDER_PAYMENT' => 8, // Chờ NCC xác nhận
            'CONFIRM_PAYMENT' => 7, // chờ duyệt chi
            'WAITING_PAYMENT' => 1, // chờ chi
            'PAID' => 4, // chờ xác nhận
            'CONFIRMED' => 2, // đã xác nhận, hoàn tất
            'CANCEL' => 3, // 1 -> huỷ
            'CANCEL_PAYMENT' => 5, // 4 -> huỷ
            'CANCEL_PAYMENT_REFUNDED' => 6, // 4 -> huỷ -> đã hoàn tiền
            'ALL_CANCEL' => '3,6',
            'ALL_PASS_PAY' => '2,4,5',
            'ALL_PAID' => '4,8',
            'NOT_CANCEL' => '0,1,2,4,5,7,8',
            'CASH_BOOK' => '2,3,4,5,6,8',
        ],
        'RestaurantPromotionTypeEnum' => [
            'UNKNOW' => '0',
            'PROMOTION_FOOD' => '1',
            'PROMOTION_ORDER' => '2',
            'PROMOTION_GOLDEN_HOUR' => '3',
            'PROMOTION_DONATE' => '4',
        ],
        'RestaurantPromotionApplyTypeEnum' => [
            'ALL' => '1',
            'MIN_ORDER_TOTAL_AMOUNT' => '2',
            'FOOD_CATEGORY' => '3',
            'FOODS' => '4',
            'CUSTOMER_GROUP' => '5',
            'UNKNOW' => '6',
        ],
        'BranchReviewTypeEnum' => [
            'GET_ALL' => '-1',
            'CHECKIN' => '0',
            'REVIEW' => '1',
            'RETAURANT_SOCIAL_CONTENT' => '2',
            'CUSTOMER_NEWS' => '3',
        ],
        'MediaContentTypeEnum' => [
            'GET_ALL' => -1,
            'IMAGE' => 1,
            'VIDEO' => 0,
        ],
        'BranchReviewCommentTypeEnum' => [
            'CUSTOMER' => '1',
            'BRANCH' => '2',
            'UNKONW' => '3',
        ],
        'RecurringCostCircleRepeatTypeEnum' => [
            'DAILY' => '1',
            'MONTHLY' => '3',
            'QUARTERLY' => '4',
            'YEARLY' => '5',
            'UNKNOW' => '6',
        ],
        'TypeFood' => [
            'FOOD' => '0',
            'COMBO' => '1',
            'ADDITION' => '2',
        ],
        'TypeSupplier' => [
            'SUPPLIER_USE' => '0',
            'SUPPLIER_NOT_USE' => '1',
            'SUPPLIER_DISABLE' => '2',
        ],
        'food_material_type' => [
            'FOOD' => '1',
            'MERCHANDISE' => '2'
        ],
        'RestaurantSocialContentTypeEnum' => [
            'FACEBOOK' => '1',
            'ZALO' => '2',
            'UNKNOW' => '3'
        ],
        'PaymentMethodEnum' => [
            'CASH' => 1,
            'BANK' => 2,
            'CASH_AND_BANK' => 3,
            'MEMBERSHIP_CARD' => 4,
            'UNKNOW' => 5,
            'TRANSFER' => 6,
            'CASH_AND_TRANSFER' => 7,
        ],
        'LogTypeEnum' => [
            'ORDER' => '0',
            'ACCOUNT' => '1',
            'BOOKING' => '2',
            'EMPLOYEE' => '3',
            'EMPLOYEE_ROLE' => '4',
            'KITCHENPLACE' => '5',
            'BRANCH' => '6',
            'FOOD' => '7',
            'WAREHOUSE' => '8',
        ],
        'ConversationTMSTypeEnum' => [
            'GET_ALL' => '012',
            'GROUP' => 3,
            'WORK' => 2,
            'PERSONAL' => 1,
        ],
        'MessageTypeEnum' => [
            'NEW' => 0,
            'TEXT' => 1,
            'IMAGE' => 2,
            'FILE' => 3,
            'STICKER' => 4,
            'VIDEO' => 5,
            'AUDIO' => 6,
            'REPLY' => 7,
            'LINK' => 8,
            'REVOKE' => 9,
            'REVOKE_REPLY' => 10,
            'REVOKE_PINNED' => 11,
            'SHARE' => 12,
            'PINNED' => 13,
            'UPDATE_NAME' => 14,
            'UPDATE_AVATAR' => 15,
            'UPDATE_BACKGROUND' => 16,
            'ADD_USER' => 17,
            'AUTHORIZE_MEMBER' => 18,
            'REMOVE_USER' => 19,
            'LEAVE_GROUP' => 20,
            'VIDEO_CALL' => 21,
            'PHONE_CALL' => 22,
            'BUSINESS_CARD' => 23,
            'ORDER' => 25,
            'SIGNATURE' => 26,
            'VOTE' => 27,
            'MESSAGE_VOTE' => 28,
        ],
        'AdditionFeeAutoGeneratedTypeEnum' => [
            'GET_ALL' => '-1',
            'VAT' => '1',
            'ORDER' => '2',
            'ORTHER' => '3',
            'DEPOSIT' => '4',
            'UNKNOW' => '5',
        ],
        'MaterialTypeEnum' => [
            'MAIN' => '1',
            'SPICE' => '2',
            'GOODS' => '3',
            'INDIRECT' => '4',
            'OTHER' => '5',
            'UNKNOW' => '6',
            'INTERNAL' => '7',
        ],
        'PostFileChatTypeEnum' => [
            "GROUP_TMS" => '1',
            "PERSONAL_TMS" => '2',
            "GROUP_ALOLINE" => '3',
            "PERSONAL_ALOLINE" => '4',
        ],
        'RestaurantVideoEnum' => [
            "PENDING" => 0,
            "REJECTED" => 1,
            "APPROVED" => 2,
            "UNKONW" => 3,
        ],
        'CategoryStickerChatEnum' => [
            "ALL" => 'all',
            "CATEGORY" => 'category-sticker',
        ],
        'ExportInventoryTypeEnum' => [
            'OTHER' => 0,
            'KITCHEN' => 1,
            'BAR' => 2,
            'BUSINESS_EMPLOYEE' => 3,
            'INTERNAL' => 4,
            'BRANCH' => 6,
            'BAR_KITCHEN' => '1,2',
            'FOUR_INVENTORY' => '1,2,3,4'
        ],
        'ImportInventoryTypeEnum' => [
            'NONE' => '',
            'UNKNOW' => '0',
            'SUPPLIER' => '1',
            'BRANCH' => '2',
        ],
        'UnitMaterialTypeEnum' => [
            'NONE' => '',
            'BIG' => 1,
            'SMALL' => 2,
        ],
        'StatusAdvanceSalaryTypeEnum' => [
            'ALL' => -1,
            'PENDING' => 0,
            'APPROVED' => 2,
            'REJECTED' => 3,
            'PAID' => 4,
        ],
        'ChecklistGoodsTypeEnum' => [
            'ALL' => '-1',
            'GOODS' => '1',
            'KITCHEN' => '2',
            'TREASURER' => '7',
        ],
        'StatusChecklistGoodsTypeEnum' => [
            'PENDING' => '0',
            'COMPLETED' => '2',
            'CANCELLED' => '3',
        ],
        'AdditionFeeObjectTypeEnum' => [
            'SUPPLIER' => 1,
            'EMPLOYEE' => 2,
            'CUSTOMER' => 3,
            'ORDER' => 4,
            'OTHER' => 5,
            'BOOKING' => 6,
        ],
        'BranchInventoryReportStatusEnum' => [
            'PENDING' => '0',
            //            'WAITING_CONFIRM' => '1',
            'CONFIRM' => '1',
            'COMPLETE' => '2',
            'CANCEL' => '3',
            'TIME' => '0,1,2',
        ],
        'InventoryReportStatusEnum' => [
            'PENDING' => 0,
            'WAITING_CONFIRM' => 1,
            'CONFIRMED' => 2,
            'CANCELLED' => 3,
            'GET_ALL' => '0,1,2,3',
            'GET_NOT_CANCEL' => '0,1,2',
        ],
        'MaterialCategoryParentId' => [
            'GET_ALL' => -1,
            'MATERIAL' => 1,
            'GOODS' => 2,
            'INTERNAL' => 3,
            'OTHER' => 12,
        ],
        'OrderSupplierInternalStatusEnum' => [
            'WEB' => "1,2",
            'PENDING' => 0,
            'WAITING_CONFIRM' => 1,
            'CONFIRMED' => 2,
            'REQUEST_ORDER_TO_SUPPLIER' => 3,
            'COMPLETED' => 4,
            'CANCELLED' => 5,
            'ACOUNT_EXPORT_MATERIAL' => 6,
            'ALL_ORDER' => '3,6',
        ],
        'OrderSupplierRestaurantStatusEnum' => [
            'WEB' => "0,1,5",
            'PENDING' => 0,
            'WAITING_CONFIRM' => 1,
            'SUPPLIER_CONFIRM' => 2,
            'CANCELLED' => 3,
            'WAITING_RESTAURANT_CREATE_SUPPLIER_ORDER' => 5,
        ],
        'OrderSupplierStatusEnum' => [
            'WEB' => "1,2,3,4,5,6,7",
            'WEB_WAITING' => "1,2,3",
            'WEB_DONE' => "4,6,7",
            'PENDING' => 0,
            'WAITING_RESTAURANT_CONFIRM' => 1,
            'WAITING_DELIVERY' => 2,
            'DELIVERING' => 3,
            'COMPLETED' => 4,
            'CANCELED' => 5,
            'RETURN_TO_SUPPLIER' => 6,
            'CONFIRM_RETURN' => 7,
        ],
        'BranchInventoryTypeEnum' => [
            'KITCHEN' => 1,
            'BAR' => 2,
        ],
        'BranchInnerInventoryType' => [
            'OTHER' => 0,
            'KITCHEN' => 1,
            'BAR' => 2,
            'EMPLOYEE_SALE' => 3,
            'EMPLOYEE_FOOD' => 4,
        ],
        'WarehouseSessionTargetTypeEnum' => [
            'GET_ALL' => '',
            'BRANCH_INNER_INVENTORY_OTHER' => 0,
            'BRANCH_INNER_INVENTORY_KITCHEN' => 1,
            'BRANCH_INNER_INVENTORY_BAR' => 2,
            'BRANCH_INNER_INVENTORY_EMPLOYEE_SALE' => 3,
            'BRANCH_INNER_INVENTORY_EMPLOYEE_FOOD' => 4,
            'SUPPLIER' => 5,
            'BRANCH' => 6,
            'OTHER' => 7,
            'INTERNAL' => '0,1,2,3,4',
            'NOT_BRANCH' => '0,1,2,3,4,5',
        ],
        'TypeSearchSupplierOrder' => [
            'RESTAURANT_MATERIAL_ORDER_REQUEST' => 1, //"YÊU CẦU NHẬP HÀNG"
            'SUPPLIER_ORDER_REQUEST' => 2, //"CHỜ NHÀ CUNG CẤP XÁC NHẬN"
            'SUPPLIER_ORDER' => 3, // "ĐƠN HÀNG , HOÀN TẤT , ĐÃ HỦY"
            //            'supplier_material_RETURN_REQUEST' => 4,//"TRẢ HÀNG"
            'supplier_material_RETURN_REQUEST' => 6, //"TRẢ HÀNG"
        ],
        'NotificationTypeEnum' => [
            'ACCOUNT' => 1,
            'TASK' => 2,
            'NEWS' => 3,
            'CHAT' => 4,
            'GROUP_CHAT' => 5,
            'LEAVE_FORM' => 6,
            'BIRTHDAY' => 7,
            'ANNOUNCEMENT' => 8,
            'KAIZEN' => 10,
            'CUSTOMER_POINT' => 11,
            'SALARY_TABLE' => 12,
            'SALARY_ADDITION' => 13,
            'ADVANCED_SALARY_REQUEST' => 14,
            'BOOKING' => 15,
            'ORDER' => 16,
            'ADVERT' => 17,
            'SUPPLIER_ORDER_REQUEST' => 18,
            'SUPPLIER_RESTAURANT_DEBT_PAYMENT_REQUEST' => 19,
            'SUPPLIER_ORDER' => 20,
            'TARGET' => 21,
        ],
        'WeekTimeType' => [
            'MONDAY' => 0,
            'TUESDAY' => 1,
            'WEDNESDAY' => 2,
            'THURSDAY' => 3,
            'FRIDAY' => 4,
            'SATURDAY' => 5,
            'SUNDAY' => 6,
        ],
        'OrderFoodStatusEnum' => [
            'CONFIRM' => -1,
            'PENDING' => 0,
            'COOKING' => 1,
            'DONE' => 2,
            'SOLD_OUT' => 3,
            'CANCEL' => 4,
            'WAITING_ONLINE' => 5,
        ],
        'EmployeeRoleTypeEnum' => [
            'GET_ALL' => -1,
            'OFFICE' => 1,
            'BUSINESS' => 2,
            'PRODUCTION' => 3,
            'MARKETING' => 4,
        ],
        'takeAwayFoodTypeEnum' => [
            'UseInPlace' => 0,
            'Buy_Take_Away' => 1,
            'Both' => 2,
        ],
        'MessageSendStatusEnum' => [
            'SEND' => 1,
            'NOT_SEND' => 2,
        ]

    ],


    'is_check' => [
        'level' => [
            'ZERO' => 0,
            'ONE' => 1,
            'TWO' => 2,
            'THREE' => 3,
            'FOUR' => 4,
            'FIVE' => 5,
        ],
        'TMS' => [
            'ENABLE' => '1',
            'DISABLE' => '0',
        ]
    ],
    'permission' => [
        /**
         * Quản lí khu vực
         */
        'AREA_TABLE_MANAGER' => 'AREA_TABLE_MANAGER', // QL khu vực
        /**
         * Quản lí món ăn
         */
        'FOOD_MANAGER' => 'FOOD_MANAGER', // QL món ăn
        /**
         * Quản lí nhân viên
         */
        'EMPLOYEE_MANAGER' => 'EMPLOYEE_MANAGER', // QL nhân viên
        /**
         * Quản lí hệ thống
         */
        'SETTING_MANAGER' => 'SETTING_MANAGER', // QL hệ thống
        /**
         * Quản lí Thứ hạng
         */
        'EMPLOYEE_RANKING_MANAGER' => 'EMPLOYEE_RANKING_MANAGER', // QL Thứ hạng
        'EMPLOYEE_RANK_MANAGER' => 'EMPLOYEE_RANK_MANAGER', // Tạo và sửa Thứ hạng
        /**
         * Quản lí kho
         */
        'WAREHOUSE_MANAGER' => 'WAREHOUSE_MANAGER', // QL kho
        /**
         * QUản lí đặt bàn
         */
        'BOOKING_MANAGER' => 'BOOKING_MANAGER', // QL đặt bàn
        /**
         * Quản lí khách hàng
         */
        'CUSTOMER_MANAGER' => 'CUSTOMER_MANAGER', // QL khách hàng
        /**
         * Quản lí giao việc
         */
        'TASK_MANAGER' => 'TASK_MANAGER', // Giao việc
        'JOB_MANAGER' => 'JOB_MANAGER', // Tạo, sửa công việc
        /**
         * Quản lí phân quyền bộ phần
         */
        'PERMISSION_ROLE_MANAGER' => 'PERMISSION_ROLE_MANAGER', // QL phân quyền bộ phận
        /**
         * Quản lí thang điểm thưởng
         */
        'SALARY_TARGET_MANAGER' => 'SALARY_TARGET_MANAGER', // QL thang điểm thưởng
        /**
         * Quản lí bậc lương
         */
        'SALARY_LEVEL_MANAGER' => 'SALARY_LEVEL_MANAGER', // QL bậc lương
        /**
         * Quản lí chủ Công ty/Nhà hàng
         */
        'OWNER' => 'OWNER', // Chủ Công ty/Nhà hàng
        /**
         * Quản lí chốt ca thu ngân
         */
        'ORDER_SESSION_MANAGER' => 'ORDER_SESSION_MANAGER', // QL chốt ca thu ngân
        /**
         * Quản lí bộ phận
         */
        'EMPLOYEE_ROLE_MANAGER' => 'EMPLOYEE_ROLE_MANAGER', // QL bộ phận
        /**
         * Quản lí ca làm việc(/shift-data)
         */
        'WORKING_SESSION_MANAGER' => 'WORKING_SESSION_MANAGER', // QL ca làm việc
        /**
         * Quản lí phân quyền nhân viên(/permission-employee)
         */
        'PERMISSION_EMPLOYEE_MANAGER' => 'PERMISSION_EMPLOYEE_MANAGER', // QL phân quyền nhân viên
        /**
         * Quản lí báo cáo
         */
        'REPORT_REVENUE' => 'REPORT_REVENUE', // Báo cáo doanh thu
        'REPORT_FOOD' => 'REPORT_FOOD', // Báo cáo thức ăn
        'REPORT_DRINK' => 'REPORT_DRINK', // Báo cáo đồ uống
        'REPORT_GIFT_FOOD' => 'REPORT_GIFT_FOOD', // Báo cáo món tặng
        'REPORT_DISCOUNT' => 'REPORT_DISCOUNT', // Báo cáo giảm giá
        'REPORT_THREE_MONTHS' => 'REPORT_THREE_MONTHS', // Báo cáo trong 3 tháng
        'REPORT_ONE_YEARS' => 'REPORT_ONE_YEARS', // Báo cáo trong 1 năm
        'REPORT_THREE_YEARS' => 'REPORT_THREE_YEARS', // Báo cáo trong 3 năm
        'REPORT_MANY_YEARS' => 'REPORT_MANY_YEARS', // Báo cáo không giới hạn time
        'REPORT_VAT' => 'REPORT_VAT', // Báo cáo VAT
        'REPORT_CUSTOMER_SLOT' => 'REPORT_CUSTOMER_SLOT', // Báo cáo số lượng khách
        'REPORT_WAREHOUSE' => 'REPORT_WAREHOUSE', // Báo cáo kho
        'REPORT_EMPLOYEE_POINT' => 'REPORT_EMPLOYEE_POINT', // Báo cáo doanh số nhân viên
        'REPORT_MATERIAL' => 'REPORT_MATERIAL', // Báo cáo nguyên liệu
        'EMPLOYEE_REVENUE_REPORT' => 'EMPLOYEE_REVENUE_REPORT', // Báo cáo doanh thu theo nhân viên
        'AREA_REVENUE_REPORT' => 'AREA_REVENUE_REPORT', // Báo cáo doanh thu theo khu vực
        'EMPLOYEE_REPORT' => 'EMPLOYEE_REPORT', // Báo cáo nhân sự
        /**
         * Quản lí thu chi
         */
        'ADDITION_FEE_MANAGER' => 'ADDITION_FEE_MANAGER', // Tạo, sửa thu chi
        'ADDITION_FEE_APPROVEMENT' => 'ADDITION_FEE_APPROVEMENT', // Kiểm duyệt phiếu thu chi
        /**
         * Quản lí bảng lương
         */
        'TMS_VIEW_EMPLOYEE_SALARY' => 'TMS_VIEW_EMPLOYEE_SALARY', // QL bảng lương
        'APPROVE_SALARY_TABLE' => 'APPROVE_SALARY_TABLE', // Duyệt bảng lương
        'PAID_SALARY_TABLE' => 'PAID_SALARY_TABLE', // Chi lương
        /**
         * Thưởng phạt nhân viên
         */
        'MANAGER_EMPLOYEE_ADDITION_SALARY' => 'MANAGER_EMPLOYEE_ADDITION_SALARY',
        'CONFIRM_EMPLOYEE_ADDITION_SALARY' => 'CONFIRM_EMPLOYEE_ADDITION_SALARY',
        'APPROVE_EMPLOYEE_ADDITION_SALARY' => 'APPROVE_EMPLOYEE_ADDITION_SALARY',
        /**
         * Quản lí nhóm chat
         */
        'TMS_CHAT_GROUP_MANAGER' => 'TMS_CHAT_GROUP_MANAGER' //Taọ nhóm chat TMS
    ],
];
