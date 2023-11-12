# Use a lastest Node image for Vue.js 3 
FROM node:latest

# Set the working directory
WORKDIR /app

# Copy package.json and package-lock.json
COPY package*.json ./

# Install global vue-cli service
RUN npm install -g @vue/cli-service

# Install dependencies
RUN npm install

# Copy the Vue.js source code into the container
COPY . .

# Expose the port Vue.js runs on
EXPOSE 8080

# Serve the application
CMD ["npm", "run", "serve"]