# moodle-react-demo
A chat app built with [React](https://facebook.github.io/react/) and packaged as a Moodle local plugin.

## Screenshot
![Screenshot](https://github.com/tonyblundell/moodle-react-demo/blob/master/screenshot.jpg)

## Overview
The app is packaged as a Moodle local plugin in local/reactchat.

The back-end code is organized with Silex and containers two controllers (one for serving the front-end code and another for serving the RESTful API).

The moodle_service_provider (local/reactchat/providers) encapsulates all dealings with Moodle.

The chat_service_provider provides means to fetch and save chat messages.

On the front-end, Chat is the main react compoment which contains all code for communicating with the server. It includes two other compoments MessageForm and MessageList (MessageList in turn includes multiple Message compoments). The react components are located in local/reactchat/static/components.

The react components are written in JSX syntax. I have included the in-browser JSX transformer and have left-out certain usual functionality such as optimistic updates in order to keep the code as minimal and readable as possible.

This isn't intended for production usage, but as a quick demo and starting point for investigating React within Moodle.
