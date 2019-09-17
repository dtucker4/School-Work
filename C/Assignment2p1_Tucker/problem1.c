#include "as2.h"

int main(void) {
	int i = 1;
	int* dataPtrTemp;
	QUEUE* queue1 = queueCreate();
	QUEUE* queue2 = queueCreate();
	

	printf("First Queue: ");
	for (; i < 11; i++) {
		enqueue(queue1, i);
		queueRear(queue1, &dataPtrTemp);
		printf("%d ", dataPtrTemp);
		
	}

	printf("\nSecond Queue: ");
	for (; i < 21; i++) {
		enqueue(queue2, i);
		queueRear(queue2, &dataPtrTemp);
		printf("%d ", dataPtrTemp);
	
	}
	catQueue(queue1, queue2);
	printf("\nConcatenated Queue: ");
	while (!queueEmpty(queue1)) {
		dequeue(queue1, &dataPtrTemp);
		printf("%d ", dataPtrTemp);
	}
	
	if (queueCount(queue1) == 0)
		queueDestroy(queue1);

	puts(" ");
	system("pause");
}