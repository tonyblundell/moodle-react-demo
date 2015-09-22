var Chat = React.createClass({
    loadMessagesFromServer: function() {
        var self = this;
        $.get(this.props.url, function(messages) {
            self.setState({messages: messages});
        });
    },

    handleMessageSubmit: function(message) {
        $.post(this.props.url, {body: message});
    },

    getInitialState: function() {
        return {messages: []};
    },

    componentDidMount: function() {
        this.loadMessagesFromServer();
        setInterval(this.loadMessagesFromServer, this.props.pollInterval);
    },

    render: function() {
        return (
            <div>
                <h2>React Chat</h2>
                <p>RESTful SPA demo built with <a href="facebook.github.io/react">React</a></p>
                <div className="well">
                    <MessageForm onMessageSubmit={this.handleMessageSubmit} />
                </div>
                <MessageList messages={this.state.messages} />
            </div>
        );
    }
});
