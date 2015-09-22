React.render(
    <Chat url="/local/reactchat/api/v0/messages" pollInterval={2000} />,
    document.getElementById('app')
);
