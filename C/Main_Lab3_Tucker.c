#include "lab3.h"

int main() {
	QUEUE_NODE = char;
	QUEUE* queue = createQueue();
	enqueue(queue, "Lakehead University");
	printf("%d", queueCount(queue));
	dequeue(queue, (void*)&queue->rear->dataPtr);

	if (queueCount(queue) == 0)
		destroyQueue(queue);
	
	system("pause");
}



