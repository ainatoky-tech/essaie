<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages & Communication - Modern Bootstrap Admin</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Real-time messaging and communication center with chat interface">
    <meta name="keywords" content="bootstrap, admin, dashboard, messages, chat, communication">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/assets/icons/favicon.svg">
    <link rel="icon" type="image/png" href="/assets/icons/favicon.png">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="/manifest.json">
    
    <!-- Preload critical fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/main-QD_VOj1Y.css">
    <style>
        .unread-badge {
            background-color: #ef4444; /* Rouge */
            color: white;
            font-size: 0.75rem;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 999px;
            min-width: 18px;
            text-align: center;
            line-height: 1;
        }
    </style>
</head>

<body data-page="messages" class="messages-page">
    <!-- Admin App Container -->
    <div class="admin-app">
        <div class="admin-wrapper" id="admin-wrapper">
            
            <!-- Header -->
            <?php require_once('common/header.php') ?>

            <!-- Sidebar -->
            <?php require_once('common/sidebar.php') ?>
            

            <!-- Main Content -->
            <main class="admin-main">
                <div class="container-fluid p-4 p-lg-4">
                    
                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h1 class="h3 mb-0">Messages</h1>
                            <p class="text-muted mb-0">Real-time communication center</p>
                        </div>
                        <div class="d-flex gap-2">

                            <button type="button" class="btn btn-outline-secondary d-lg-none" @click="toggleSidebar()">
                                <i class="bi bi-list me-2"></i>Conversations
                            </button>
                            <button type="button" class="btn btn-outline-secondary" @click="markAllRead()">
                                <i class="bi bi-check-all me-2"></i>Mark All Read
                            </button>
                            <button type="button" class="btn btn-primary" @click="newConversation()">
                                <i class="bi bi-plus-lg me-2"></i>New Message
                            </button>
                        
                        </div>
                    </div>

<!----------------------------------------------------- Messages Container --------------------------------------------------------------------------------->
                    <div x-data="messagesComponent" x-init="init()" class="messages-container">
                        <div class="messages-layout">
                            
                            <!-- Conversations Sidebar -->
                            <div class="messages-sidebar" :class="{ 'mobile-show': sidebarVisible }">
                                <!-- Sidebar Header -->
                                <div class="messages-header">
                                    <h5 class="header-title mb-0">Messages</h5>
                                    <div class="d-flex gap-2 mt-3">
                                        <div class="search-container flex-grow-1">
                                            <input type="search" 
                                                id="searchUsers" 
                                                class="form-control" 
                                                placeholder="Search conversations...">
                                            <i class="bi bi-search search-icon"></i>
                                        </div>
                                        <button class="btn btn-primary btn-sm" @click="newConversation()" title="New Message">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>
                  
                                

<!----------------------------------------------------- Conversations List ------------------------------------------------------------------------------------>
                                <div class="conversations-list" id="conversations-list">
                                    
                <!----------------------- Empty state for conversations ---------------------------------------------------------------->
                                    <div id="empty-state" class="empty-conversations" style="display: none;">
                                        <i class="bi bi-chat-dots"></i>
                                        <p>No conversations found</p>
                                    </div>

                                </div>
<!--------------------------------------------------------------------------------------------------------------------------->
                            </div>

                            <!-- Chat Area -->
                            <div class="chat-area">
                                <!-- Active Chat -->
                                <div class="active-chat" x-show="selectedConversation">
                                    <!-- Chat Header -->
                                    <div class="chat-header">

                                        <div class="chat-user-info">
                                            <button class="btn btn-link d-lg-none me-2 p-0" @click="sidebarVisible = !sidebarVisible">
                                                <i class="bi bi-arrow-left fs-5"></i>
                                            </button>
                                            <div class="chat-avatar-container">
                                                <img src="" id="activeChatAvatar" class="chat-avatar" alt="" style="display: none;">
                                                <div class="online-indicator" id="activeChatOnline" style="display: none;"></div>
                                            </div>
                                            <div class="chat-details">
                                                <h6 class="chat-name" id="activeChatName">Sélectionnez une discussion</h6>
                                                <p class="chat-status" id="activeChatStatus">Cliquez sur un contact pour parler</p>
                                            </div>
                                        </div>

                                        <div class="chat-actions">
                                            <button class="btn" @click="videoCall()" title="Video Call">
                                                <i class="bi bi-camera-video"></i>
                                            </button>
                                            <button class="btn" @click="voiceCall()" title="Voice Call">
                                                <i class="bi bi-telephone"></i>
                                            </button>

                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle" data-bs-toggle="dropdown" title="More Options">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#" @click.prevent="muteConversation()">
                                                        <i class="bi bi-bell-slash me-2"></i>Mute notifications
                                                    </a></li>
                                                    <li><a class="dropdown-item" href="#" @click.prevent="archiveConversation()">
                                                        <i class="bi bi-archive me-2"></i>Archive chat
                                                    </a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#" @click.prevent="deleteConversation()">
                                                        <i class="bi bi-trash me-2"></i>Delete chat
                                                    </a></li>
                                                </ul>

                                            </div>

                                        </div>

                                    </div>

<!-------------------------------------------------------------------- Messages Area ---------------------------------------------------------------------------->
                                    <div class="chat-messages" id="chatMessages">
                                        <div id="messagesBody"></div>

                                        <div class="typing-indicator" id="typingIndicator" style="display: none;">
                                            <div class="typing-content">
                                                <div class="typing-dots">
                                                    <div class="dot"></div><div class="dot"></div><div class="dot"></div>
                                                </div>
                                                <span class="typing-text">typing...</span>
                                            </div>
                                        </div>
                                    </div>

<!--------------------------------------------------------------- Message Input --------------------------------------------------------------------->
                                    <div class="chat-input">
                                        <div class="input-container">
                                            <div class="input-actions">
                                                <button class="btn" type="button" id="btnAttach" title="Attach file">
                                                    <i class="bi bi-paperclip"></i>
                                                </button>
                                            </div>
                                            
                                            <input type="hidden" name="idOther" id="idOther" value="">
                                            <input type="hidden" name="idUser" id="idUser" value="<?php echo $_SESSION['utilisateur']['id'] ?? ''; ?>">
                                            
                                            <div class="message-input">
                                                <textarea class="form-control" id="message" placeholder="Type a message..." rows="1" style="resize: none;"></textarea>
                                            </div>

                                            <div class="input-actions">
                                                <button class="btn" type="button" id="btnEmoji" title="Add emoji">
                                                    <i class="bi bi-emoji-smile"></i>
                                                </button>
                                                <button class="btn btn-primary" type="button" id="btnEnvoyer" title="Send message">
                                                    <i class="bi bi-send"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="emoji-picker" id="emojiPicker" style="display: none;">
                                            <div class="emoji-grid" id="emojiGrid">
                                                </div>
                                        </div>
                                    </div>
<!----------------------------------------------------------------------------------------------------------------------------------------------------->
                                </div>

<!-------- Empty Chat State lorsque tu mets fin a une conversation il supprime toute la conversation --------------------------------------------->
                                <div id="emptyChat" class="empty-state-container">
                                    <div class="text-center p-5">
                                        <i class="bi bi-chat-dots fs-1"></i>
                                        <p>Sélectionnez un utilisateur pour commencer à discuter</p>
                                    </div>
                                </div>
<!----------------------------------------------------------------------------------------------------------------------->

                            </div>

                        </div>
                    </div>

                </div>
            </main>

<!----------------------------------------------------- Footer -------------------------------------------------------------------->
        <?php require_once('footer/footer.php') ?>
            

        </div> <!-- /.admin-wrapper -->
    </div>

    <script src="/assets/js/Message.js"></script>
    <script src="/assets/js/Search.sj"></script>
    <!-- Page-specific Component -->
    <!--script type="module" src="/assets/js/messages-ByGNYy7N.js"></script-->

    <!-- Main App Script -->
    <!--script type="module" src="/assets/js/main-BrdaXYSd.js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const toggleButton = document.querySelector('[data-sidebar-toggle]');
        const wrapper = document.getElementById('admin-wrapper');

        if (toggleButton && wrapper) {
          const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
          if (isCollapsed) {
            wrapper.classList.add('sidebar-collapsed');
            toggleButton.classList.add('is-active');
          }

          toggleButton.addEventListener('click', () => {
            const isCurrentlyCollapsed = wrapper.classList.contains('sidebar-collapsed');
            
            if (isCurrentlyCollapsed) {
              wrapper.classList.remove('sidebar-collapsed');
              toggleButton.classList.remove('is-active');
              localStorage.setItem('sidebar-collapsed', 'false');
            } else {
              wrapper.classList.add('sidebar-collapsed');
              toggleButton.classList.add('is-active');
              localStorage.setItem('sidebar-collapsed', 'true');
            }
          });
        }
      });
    </script>-->
</body>
<script type="module" src="/assets/js/main-BrdaXYSd.js"></script>
</html>